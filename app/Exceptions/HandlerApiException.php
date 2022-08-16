<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class HandlerApiException extends Exception
{
    private $response;

    public function handleError($exception)
    {
        $shortName = lcfirst((new \ReflectionClass($exception))->getShortName());
        if (method_exists($this, $shortName)) {
            return $this->$shortName($exception);
        }
        $this->internalServerError($exception);
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    private function notFoundHttpException()
    {
        return Response::errorResponse('Not Found', null, ResponseStatus::HTTP_NOT_FOUND);
    }

    private function modelNotFoundException()
    {
        return Response::errorResponse('Item not Found', null, ResponseStatus::HTTP_NOT_FOUND);
    }

    private function internalServerError(Exception $exception)
    {
        $message = $exception->getMessage() . "- FILE:>" . $exception->getFile() . "- LINE:>" . $exception->getLine();
        return Response::errorResponse($message, null, ResponseStatus::HTTP_INTERNAL_SERVER_ERROR);
    }

    private function authenticationException(Exception $exception)
    {
        return Response::errorResponse("Unauthenticated", null, ResponseStatus::HTTP_UNAUTHORIZED);
    }

    private function validationException(Exception $exception)
    {
        $errors = $exception->validator->errors();
        $data   = [];
        foreach ($errors->toArray() as $field => $error) {
            $data[] = [
                "field" => $field,
                "msg"   => $error[0]
            ];
        }
        return Response::errorResponse($errors->first(), $data, ResponseStatus::HTTP_UNPROCESSABLE_ENTITY);
    }

    private function badRequestHttpException(Exception $exception)
    {

        return Response::errorResponse($exception->getMessage(), null, $exception->getCode());
    }

    private function noPermissionException(Exception $exception)
    {
        return Response::errorResponse($exception->getMessage(), null, ResponseStatus::HTTP_FORBIDDEN);
    }

    private function notAcceptableHttpException(Exception $exception)
    {
        return Response::errorResponse($exception->getMessage(), null, ResponseStatus::HTTP_NOT_ACCEPTABLE);
    }

    private function authorizationException(Exception $exception)
    {
        return $this->noPermissionException($exception);
    }

}
