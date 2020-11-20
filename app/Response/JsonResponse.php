<?php
namespace App\Http\Response;

trait JsonResponse{
    public function success($msg,$data=[]){
        return $this->JsonResponse(0000,$msg,$data);
    }

    public function error($msg,$data=[]){
        return $this->JsonResponse(0001,$msg,$data);
    }

    public function JsonResponse($code,$msg,$data=[]){
        $data = [
            'code'=>$code,
            'msg'=>$msg,
            'data'=>$data
        ];
        return response()->json($data);
    }
}
