<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\FilmRepository;
use Carbon\Carbon;

class OrderController extends Controller{
    public function __construct(
		OrderRepository $orderRepo,
		CustomerRepository $customerRepo,
		FilmRepository $filmRepo
	){
        $this->orderRepo = $orderRepo;
        $this->customerRepo = $customerRepo;
        $this->filmRepo = $filmRepo;
    }

    public function index(Request $request){
        $res = $this->orderRepo->ordering('created_at', 'asc')->find($request->get('total'));
        return $this->response(['results' => $res]);
    }

    public function store(Request $request){
		$validator = \Validator::make($request->all(), [
            'ticket_code' => 'required|exists:tickets,code',
            'customer_code' => 'required|exists:customers,code',
            'buy' => 'required|numeric',
        ]);

		if ($validator->fails()) return $this->validationError(['errors' => $validator->messages()]);

		if($this->filmRepo->filterStock()  > 0):
			$ticket_code = $request->get("ticket_code");
			$buy = $request->get("buy");

			$save = $this->orderRepo->setFields([
				'ticket_code' => $ticket_code,
				'customer_code' => $request->get("customer_code"),
				'buy' => $buy,
			])->save();

			if($save['saved'] === true):
				$data = $this->filmRepo->findByCode($ticket_code);
				if (is_null($data)) return $this->dataNotFound([
					'status_code' => 404,
					'message' => 'Data not Found!'
				]);
				$data->quantity = $data->quantity - $buy;
				return $data->save() === true ? $this->response(['results' => $save['data']]) : $this->serverError();
			else:
				return $this->serverError();
			endif;
		else:
			return $this->unprocessable([
					'status_code' => 404,
					'message' => 'The ticket is out of stock'
			]);
		endif;

    }

    public function show($code){
		$order = $this->orderRepo->findByCode($code);
        return is_null($order) ? $this->dataNotFound([
			'status_code' => 404,
			'message' => 'Data not Found!'
		]) : $this->response(['results' => $order]);
	}

	public function update(Request $request, $code){
		$validator = \Validator::make($request->all(), ['customer_code' => 'required|exists:customers,code']);
		$data = $this->orderRepo->findByCode($code);
        if (is_null($data)) {
            return $this->dataNotFound([
				'status_code' => 404,
				'message' => 'Data not Found!'
			]);
		}

		$data->customer_code = $request->get('customer_code');
		return $data->save() === true ? $this->response(['results' => $data]) : $this->serverError();
	}

	public function deleteOrder($order_code){
		$delete = $this->orderRepo->where(["code" => $order_code])->delete();
		return $delete == true ? $this->response(['message' => 'Order Deleted', 'results' => $delete]) : $this->serverError();
	}

	public function deleteMultipleOrder($order_code){
		foreach ($order_code as $key => $code):
			$task = $this->show($code);
			$getData = $task->getData();
			$task_id[] = $getData->status_code == "success" ? $getData->results->id : 0;
		endforeach;
		return $this->orderRepo->destroy($task_id) > 0 ? $this->response(['message' => 'Task Deleted', 'results' => 'success']) : $this->serverError();
	}

    public function delete(Request $request){
		$validator = \Validator::make($request->all(), ['order_code' => 'required']);
		$order_code = $request->get("order_code");
        if ($validator->fails()) return $this->validationError(['errors' => $validator->messages()]);
		$is_arr = is_array($order_code);

		if($is_arr == false):
			$task = $this->show($order_code);
			$result = $task->getData()->status_code != 404 ? $this->deleteOrder($order_code) : $task;
		else:
			$result = $this->deleteMultipleOrder($order_code);
		endif;

		return $result;
	}
	
	public function customerDetail($code){
		$customers = $this->customerRepo->likeByCode($code);
        return is_null($customers) ? $this->dataNotFound([
			'status_code' => 404,
			'message' => 'Data not Found!'
		]) : $this->response(['results' => $customers]);
	}

	public function customers(){
		$res = $this->customerRepo->ordering('created_at', 'asc')->find();
        return $this->response(['results' => $res]);
	}


	public function films(){
		$res = $this->filmRepo->ordering('created_at', 'asc')->find();
        return $this->response(['results' => $res]);
	}

	public function filmDetail($code){
		$films = $this->filmRepo->likeByCode($code);
        return is_null($films) ? $this->dataNotFound([
			'status_code' => 404,
			'message' => 'Data not Found!'
		]) : $this->response(['results' => $films]);
	}
}