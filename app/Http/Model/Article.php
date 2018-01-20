<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    //
    protected $table = 'article';
    protected $primaryKey = 'arc_id';
    public $timestamps = true;
    protected $guarded = ['arc_tag'];

    public function saveArticle($input)
    {
    	$result = $this->create($input);
    	if ($result) {
            //保存文章标签
    		foreach ($input['arc_tag'] as $tag) {
	    		$article['tag_id'] = $tag;
	    		$article['arc_id'] = $result->arc_id;
	    		DB::table('article_tag')->insert($article);	
	    	}
	    	return ['valid'=>1, 'msg'=>'文章添加成功！'];
    	} else {
    		return ['valid'=>0, 'msg'=>'文章添加失败，请稍后重试！'];
    	}	
    }

    public function updateArticle($input, $arc_id)
    {
        $arc_tags = $input['arc_tag'];
        //更新文章数据
        unset($input['arc_tag']);
        $result = $this->where('arc_id',$arc_id)->update($input);
        if($result){
            //更新文章的标签数据
            //先把这篇文章原来的标签先删除后重新添加
            DB::table('article_tag')->where('arc_id', $arc_id)->delete();
            //保存文章标签
            foreach ($arc_tags as $tag) {
                $article['tag_id'] = $tag;
                $article['arc_id'] = $arc_id;
                DB::table('article_tag')->insert($article); 
            }
            return ['valid'=>1, 'msg'=>'文章更新成功！'];
        }else{
            return ['valid'=>0, 'msg'=>'文章更新失败，请稍后重试！'];
        }
    }

    public function delArticle($arc_id)
    {
        if ($arc_id) {
            //先找出该文章的图片路径
            $article = $this->find($arc_id, ['arc_thumb']);

            $result = $this->where('arc_id', $arc_id)->delete();
            if ($result) {
                //把图片从硬盘中删除
                if ($article) {
                    unlink('.' . $article->arc_thumb);
                }
                
                $res = DB::table('article_tag')->where('arc_id', $arc_id)->delete();

                return ['valid'=>1, 'msg'=>'文章删除成功！'];
            } else {
                return ['valid'=>0, 'msg'=>'文章删除失败，请稍后重试！'];
            }
        } else {
             return ['valid'=>0, 'msg'=>'请指定要删除的文章!'];
        }
    }
}
