<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;
    protected $guarded = [];

    public function getTree()
    {
        $categories = $this->orderBy('cate_sort', 'asc')->get();
        return $this->_getTree($categories, 'cate_name');
    }

    public function getChildren($cateId)
    {
        $data = $this->all();
        return $this->_getChildren($data, $cateId, TRUE);
    }

    /**
	 * 递归从数据中找子分类
	 */
	private function _getChildren($data, $cate_id, $isClear = FALSE)
	{
		static $_ret = [];  // 保存找到的子分类的ID
		if($isClear)
            $_ret = [];
		// 循环所有的分类找子分类
		foreach ($data as $k => $v)
		{
			if($v['cate_pid'] == $cate_id)
			{
				$_ret[] = $v['cate_id'];
				// 再找这个$v的子分类
				$this->_getChildren($data, $v['cate_id']);
			}
		}
		return $_ret;
	}

    /**
     * 获取分类树
     * @param \Illuminate\Database\Eloquent\Collection | App\Http\Model\Catagory
     * @param int $parent_id
     * @param int $level
     * @return \Illuminate\Database\Eloquent\Collection | []
     */
    public function _getTree($data, $field_name, $parent_id=0, $level=0)
	{
		static $_ret = [];
		foreach ($data as $k => $v)
		{
			if ($v->cate_pid == $parent_id)
			{
				$data[$k]['_'.$field_name] = str_repeat('|----', $level) . $data[$k][$field_name];
				$_ret[] = $v;
				// 找子分类
				$this->_getTree($data, $field_name, $v->cate_id, $level+1);
			}
		}
		return $_ret;
	}
}
