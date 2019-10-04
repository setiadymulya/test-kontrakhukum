<?php

namespace App\Traits;

trait ApiResponse
{
    protected $status = 'success';
    protected $httpStatus = 200;

    public function response($params = [])
    {
        $resParams = [
            'status' => $this->status,
            'status_code' => !empty($params['status_code']) ? $params['status_code'] : 'success',
            'message' => !empty($params['message']) ? $params['message'] : 'Success'
        ];

        if (!empty($params['results'])) $resParams['results'] = $params['results'];
        if (!empty($params['errors'])) $resParams['errors'] = $params['errors'];

        return response()->json($resParams, $this->httpStatus);
    }

    public function dataNotFound($params = [])
    {
        $this->status = 'success';
        $this->httpStatus = 200;
        $params['message'] = !empty($params['message']) ? $params['message'] : 'Data not Found!';
        $params['status_code'] = !empty($params['status_code']) ? $params['status_code'] : 'not_found';

        return $this->response($params);
    }

    public function validationError($params = [])
    {
        $this->status = 'errors';
        $this->httpStatus = 400;
        $params['message'] = !empty($params['message']) ? $params['message'] : 'Validation Failed!';
        $params['status_code'] = !empty($params['status_code']) ? $params['status_code'] : 'validation_failed';

        return $this->response($params);
    }

    public function unauthorized($params = [])
    {
        $this->status = 'errors';
        $this->httpStatus = 401;
        $params['message'] = !empty($params['message']) ? $params['message'] : 'Unauthorized User!';
        $params['status_code'] = !empty($params['status_code']) ? $params['status_code'] : 'unauthorized';

        return $this->response($params);
    }

    public function forbidden($params = [])
    {
        $this->status = 'errors';
        $this->httpStatus = 403;
        $params['message'] = !empty($params['message']) ? $params['message'] : 'Access Forbidden!';
        $params['status_code'] = !empty($params['status_code']) ? $params['status_code'] : 'forbidden';

        return $this->response($params);
    }

    public function unprocessable($params = [])
    {
        $this->status = 'errors';
        $this->httpStatus = 422;
        $params['message'] = !empty($params['message']) ? $params['message'] : 'Unprocessable Entity / Validation Failed!';
        $params['status_code'] = !empty($params['status_code']) ? $params['status_code'] : 'validation_failed';

        return $this->response($params);
    }

    public function serverError($params = [])
    {
        $this->status = 'errors';
        $this->httpStatus = 500;
        $params['message'] = !empty($params['message']) ? $params['message'] : 'Internal Server Error !!!';
        $params['status_code'] = !empty($params['status_code']) ? $params['status_code'] : 'internal_server_error';

        return $this->response($params);
    }
}