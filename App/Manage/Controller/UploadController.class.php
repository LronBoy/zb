<?php
/***********************************************************
 * copyright(C): Jeffry<w@jeffry.cn>
 * description:  文件上传控制器
 * version:      v1.0.0
 * function:     包含方法列表
 *
 * @author:      Pante
 * @datetime:    2018/1/31 16:21
 * @others:      Use the PhpStorm
 *
 * history:      修改记录
 ***********************************************************/
namespace Manage\Controller;

use Think\Upload;

class UploadController extends ComController
{
    public function index($type = null)
    {

    }
	
	/**
	 * description: 音频上传
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/22 15:24
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function uploadAudio(){
		$mimes = array(
			'audio/mpeg',
		);
		$exts = array(
			'mp3',
		);
		$upload = new Upload(array(
			'mimes' => $mimes,
			'exts' => $exts,
			'rootPath' => './Public/',
			'savePath' => 'attached/'.date('Y')."/".date('m')."/",
			'subName'  =>  array('date', 'd'),
		));
		$info = $upload->upload($_FILES);
		if(!$info) {// 上传错误提示错误信息
			$error = $upload->getError();
			$return  = array('status' => 0, 'info' => '失败', 'data' => $error);
		}else{// 上传成功
			foreach ($info as $item) {
				$filePath[] = __ROOT__."/Public/".$item['savepath'].$item['savename'];
			}
			$ImgStr = implode("|", $filePath);
			$return  = array('status' => 1, 'info' => '上传成功', 'data' => $ImgStr);
		}
		//返回JSON数据
		exit(json_encode($return));
	}
	
	/**
	 * description: 视频上传
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/22 15:24
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
	public function uploadVideo(){
		$mimes = array(
			'video/mp4',
		);
		$exts = array(
			'mp4',
		);
		$upload = new Upload(array(
			'mimes' => $mimes,
			'exts' => $exts,
			'rootPath' => './Public/',
			'savePath' => 'attached/'.date('Y')."/".date('m')."/",
			'subName'  =>  array('date', 'd'),
		));
		$info = $upload->upload($_FILES);
		if(!$info) {// 上传错误提示错误信息
			$error = $upload->getError();
			$return  = array('status' => 0, 'info' => '失败', 'data' => $error);
		}else{// 上传成功
			foreach ($info as $item) {
				$filePath[] = __ROOT__."/Public/".$item['savepath'].$item['savename'];
			}
			$ImgStr = implode("|", $filePath);
			$return  = array('status' => 1, 'info' => '上传成功', 'data' => $ImgStr);
		}
		//返回JSON数据
		exit(json_encode($return));
	}
	
	/**
	 * description: 图片上传
	 *+-----------------------------------------------
	 * @author:     Pante  2018/2/22 15:25
	 * @access:     public
	 *+-----------------------------------------------
	 * @history:    更改记录
	 */
    public function uploadpic(){
        $Img = I('Img');
        $Path = null;
        if ($_FILES['img']) {
            $Img = $this->saveimg($_FILES);
        }
        $BackCall = I('BackCall');
        $Width = I('Width');
        $Height = I('Height');
        if (!$BackCall) {
	        $BackCall = $_POST['BackCall'];
        }
        if (!$Width) {
            $Width = $_POST['Width'];
        }
        if (!$Height) {
	        $Height = $_POST['Height'];
        }
        $this->assign('Width', $Width);
        $this->assign('BackCall', $BackCall);
        $this->assign('Img', $Img);
        $this->assign('Height', $Height);
        $this->display('Uploadpic');
    }

    private function saveimg($files)
    {
        $mimes = array(
            'image/jpeg',
            'image/jpg',
            'image/jpeg',
            'image/png',
            'image/pjpeg',
            'image/gif',
            'image/bmp',
            'image/x-png'
        );
        $exts = array(
            'jpeg',
            'jpg',
            'jpeg',
            'png',
            'pjpeg',
            'gif',
            'bmp',
            'x-png'
        );
        $upload = new Upload(array(
            'mimes' => $mimes,
            'exts' => $exts,
            'rootPath' => './Public/',
            'savePath' => 'attached/'.date('Y')."/".date('m')."/",
            'subName'  =>  array('date', 'd'),
        ));
        $info = $upload->upload($files);
        if(!$info) {// 上传错误提示错误信息
            $error = $upload->getError();
            echo "<script>alert('{$error}')</script>";
        }else{// 上传成功
            foreach ($info as $item) {
                $filePath[] = __ROOT__."/Public/".$item['savepath'].$item['savename'];
            }
            $ImgStr = implode("|", $filePath);
            return $ImgStr;
        }
    }

    public function batchpic()
    {
        $ImgStr = I('Img');
        $ImgStr = trim($ImgStr, '|');
        $Img = array();
        if (strlen($ImgStr) > 1) {
            $Img = explode('|', $ImgStr);
        }
        $Path = null;
        $newImg = array();
        $newImgStr = null;
        if ($_FILES) {
            $newImgStr = $this->saveimg($_FILES);
            if ($newImgStr) {
                $newImg = explode('|', $newImgStr);
            }

        }
        $Img = array_merge($Img,$newImg);
        $ImgStr = implode("|", $Img);
        $BackCall = I('BackCall');
        $Width = I('u');
        $Height = I('Height');
        if (!$BackCall) {
            $Width = $_POST['BackCall'];
        }
        if (!$Width) {
            $Width = $_POST['Width'];
        }
        if (!$Height) {
            $Width = $_POST['Height'];
        }
        $this->assign('Width', $Width);
        $this->assign('BackCall', $BackCall);
        $this->assign('ImgStr', $ImgStr);
        $this->assign('Img', $Img);
        $this->assign('Height', $Height);
        $this->display('Batchpic');
    }
}
