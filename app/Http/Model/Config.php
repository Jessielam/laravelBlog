<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    //
    protected $table = 'config';
    protected $primaryKey = 'conf_id';
    public $timestamps = false;
    protected $guarded = [];

     //把网站配置信息保存在配置文件中
    public function generateFile()
    {
    	$configs = Config::pluck('conf_content', 'conf_name')->all();

    	$configStr = var_export($configs, true);
    	$string = "<?php\n\nreturn " . $configStr .";";
    	$confPath = base_path() . '\config\systemconfig.php';

    	file_put_contents($confPath, $string);
    }
}
