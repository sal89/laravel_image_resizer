<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use View;
use Session;
use File;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ImageModel;
use \Eventviva\ImageResize;

class ImageResizer extends Controller
{

	function __construct(){
		$this->upload_path = 'uploads';
	}

	/**
	 * Display the form
	 */
    public function index()
    {
    	return View::make('home');
    }

    /**
     * Upload the image, resize and store request in DB
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function upload(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'image' => 'required|mimes:jpeg,bmp,png',
			'width' => 'required',
			'height' => 'required',
		]);

        if ($validator->fails()) {
            return redirect('/')
                        ->withErrors($validator)
                        ->withInput();
        } else {
			$_image  = $request->file('image');
			$_width  = $request->input('width');
			$_height = $request->input('height');

			$extension = $_image->getClientOriginalExtension();
			$fileName  = time().'_'.md5(rand(0,9999)).'.'.$extension;

			if ($_image->isValid()) {
				// Uploading file to given path
				$_image->move($this->upload_path, $fileName);

				// Resize the uploaded image
				$image = new ImageResize($this->upload_path . '/' . $fileName);
				$image->resize($_width, $_height);
				$image->save($this->upload_path . '/' . $fileName);

				// Save the request info
				$model = new ImageModel;
				$model->filename = $_image->getClientOriginalName();
				$model->width    = $_width;
				$model->height   = $_height;
				$model->save();

				// Delete the uploaded file
				$file_contents = file_get_contents($this->upload_path . '/' . $fileName);
				File::delete($this->upload_path . '/' . $fileName);

				return response($file_contents)
				            ->header('Content-Type', 'image/jpg')
				            ->header('Content-Transfer-Encoding', 'Binary')
				            ->header('Content-disposition', 'attachment; filename="'.$_image->getClientOriginalName().'"');
			}else {
				Session::flash('error', 'Something went wrong while uploading the image.');
				return redirect('/');
			}
        }
    }
}
