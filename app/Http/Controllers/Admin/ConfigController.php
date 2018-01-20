<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfigStorePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ConfigController extends CommonController
{
	private $configModel;

	public function __construct(
		\App\Http\Model\Config $configModel
	) {
		$this->configModel = $configModel;
	}

    //
     public function index()
    {
    	//获取所有的网站配置
    	$configs = Config::orderBy('sort', 'asc')->get();
    	foreach ($configs as &$config) {
    		$name = "conf_content[$config->conf_id]";
    		switch ($config->inc_type) {
    			case 'text':
    				$config->_html = '<input type="text" name="'.$name.'" class="lg" value="'.$config->conf_content.'">';
    				break;
    			case 'textarea':
					$config->_html = '<textarea class="lg" name="'.$name.'">'.$config->conf_content.'</textarea>';
    				break;
    			case 'radio':
    				$options = explode(',', $config->field_value);
    				$str = '';
    				foreach($options as $option) {
    					$valLabel = explode('|', $option);
    					$isChecked = $valLabel[0] == $config->conf_content ? ' checked ' : '';
    					$str .= '<input type="radio" name="'.$name.'"'.$isChecked.' value="'.$valLabel[0].'">'. $valLabel[1] .'&nbsp&nbsp';
    				}
    				$config->_html = $str;
    				break;
    		}	
    	}
    	return view('admin.config.index', compact('configs'));
    }

    //创建
    public function create()
    {
		return view('admin.config.add');
    }

    //数据新增保存
    public function store(ConfigStorePost $request)
    {
    	$input = Input::except('_token');

    	//保存数据
    	$result = Config::create($input);
    	 if ($result) {
            //数据添加成功
             return redirect('admin/config');
        } else {
            return back()->with('errors', '友链添加失败，请稍后重试！');
        }
    }

    public function show()
    {

    }

	/**
     * @method GET
     */
    public function edit($conf_id)
    {
    	$config = Config::find($conf_id);
    	return view('admin.config.edit', compact('config'));
    }

    //数据更新保存
    public function update(ConfigStorePost $request, $conf_id)
    {
    	$config = Input::except('_token', '_method');
    	if (!isset($config['field_value'])) {
    		$config['field_value'] = '';
    	}

    	$result = Config::where('conf_id', $conf_id)->update($config);

    	 if ($result) {
            //数据修改成功
            $this->configModel->generateFile(); //把配置信息保存到配置文件中
            return redirect('admin/config');
        } else {
            return back()->with('errors', '友链更新失败，请稍后重试！');
        }
    }

    //delete.admin/config/{config}
    public function destroy($conf_id)
    {
        $result = Config::where('conf_id', $conf_id)->delete();
        if ($result) {
        	//把配置信息保存到配置文件中
        	$this->configModel->generateFile();
            $data = ['status' => 1, 'msg' => '友链删除成功!'];
        } else {
            $data = ['status' => 0, 'msg' => '友链删除失败，请稍候重试!'];
        }
        return $data;
    }
    
    //修改排序
    public function sort()
    {
    	$input = Input::all();
        $config = Config::find($input['conf_id']);
        $config->sort = $input['conf_sort'];
        $result = $config->update();
        if ($result) {
            $data = ['status' => 0, 'msg' => '排序更新成功!'];
        } else {
            $data = ['status' => 1, 'msg' => '排序更新失败，请稍候重试!'];
        }

        return $data;
    }

    //保存配置内容
    public function saveContent()
    {
    	$input = Input::all();	
    	foreach($input['conf_content'] as $conf_id => $confContent) {
    		Config::where('conf_id', $conf_id)->update(['conf_content' => $confContent]);
    	}
    	$this->configModel->generateFile();
    	return back()->with('errors', '内容更新成功！');
    }
}
