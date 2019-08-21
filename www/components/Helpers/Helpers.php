<?php


namespace Components\Helpers;


class Helpers
{
    public static function renderBreadcrumb()
    {
        $uri=$_SERVER['REQUEST_URI'];
        $segments=explode('/',$uri);
        array_shift($segments);
        if(empty($segments[count($segments)-1]))
        {
            array_pop($segments);
        }
        $list='';
        for($i=0;$i!=count($segments);++$i)
        {
            $href='';
            for($j=0;$j<=$i;++$j)
            {
                $href.='/'.$segments[$j];
            }
            $name=ucfirst($segments[$i]);
            if((count($segments)-1)===$i)
            {
                $list.=<<<ITEM
    <li class="breadcrumb-item active">$name</li>
ITEM;
            }
            else
            {
                $list.=<<<ITEM
    <li class="breadcrumb-item"><a href="$href">$name</a></li>
ITEM;
            }


        }

        $str=<<<CONTENT
    <div class="row justify-content-start">
            <div class="col-auto">
                <div>
                <ol class="breadcrumb mt-3">
                    $list
                </ol>
                </div>
            </div>
        </div>
CONTENT;

        return $str;
    }

    public static function  renderTitle($title)
    {
        return <<<CONTENT
            <div class="row">
        <div class="col text-center">
            <h4>$title</h4>
        </div>
    </div>
CONTENT;

    }

    public static function renderBtnCreate($title)
    {
        $href=$_SERVER['REQUEST_URI'];
        $href= (mb_substr($href,-1)==='/')?$href.'create':'/create';
        return <<<CONTENT
    <div class="row">
        <div class="col">
        <a href="$href" class="btn btn-default back mb-2"><i class="fa fa-plus"></i>$title</a>
        </div>
    </div>
CONTENT;
    }

    public static function renderError($errors)
    {
        $str='';
        if (isset($errors) && is_array($errors))
        {
            $list='';
            foreach ($errors as $v){
                $list.=<<<ITEM
    <p>$v</p>
ITEM;

            }
            $str=<<<CONTENT
<div class="alert alert-dismissible alert-secondary">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
    $list
</div>
CONTENT;
        }

        return $str;
    }

    public static function sanitize($value)
    {
        return htmlspecialchars(strip_tags($value));
    }
}