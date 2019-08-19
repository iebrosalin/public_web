<?php


namespace Services;


class RenderView
{
    public static function table(array $data,string $name_table='')
    {
        if (count($data) < 0) {
            return null;
        }
        $res='';
        if($name_table!==''){
            $res.=<<<TABLE_NAME
                <h6>$name_table</h6>
TABLE_NAME;
        }

        $res.= <<<TABLE_HEAD_START
<table class="table">
                <thead class="thead-light">
                <tr>
TABLE_HEAD_START;
        foreach ($data[0] as $col_name => $col_val) {
            $res .= <<<CONTENT_HEAD
                    <th>$col_name</th>
CONTENT_HEAD;
        }
        $res .= <<<TABLE_HEAD_END
                    </tr>
                </thead>
TABLE_HEAD_END;
        $res .= <<<TABLE_BODY_START
                <tbody>
TABLE_BODY_START;
        foreach ($data as $row) {
            $res .= <<<CONTENT_ROW_START
                    <tr>
CONTENT_ROW_START;
            $i = 0;
            foreach ($row as $col_val) {
                if ($i == 0) {
                    $res .= <<<CONTENT_ROW_1
                                    <td scope="row">$col_val</td>
CONTENT_ROW_1;
                } else {
                    $res .= <<<CONTENT_ROW_2
                                     <td>$col_val</td>
CONTENT_ROW_2;
                }
                ++$i;

            }
            $res .= <<<CONTENT_ROW_END
                    </tr>
CONTENT_ROW_END;
        }
        $res .= <<<TABLE_BODY_END
                </tbody>
            </table>
TABLE_BODY_END;
        return $res;
    }
    public static function query(array $query)
    {
        $content='';
        foreach ($query as $v){
            $content.=$v."\n";
        }
        $res=<<<CONTENT
        <pre>
        $content
        </pre>
        <h5>Результат:</h5>
CONTENT;

    }
    public static function tableWithQuery(array $query,array $data,string $name_table=''){
        $res='';
        $res.=self::query($query);
        $res.=self::table($data,$name_table);
        return $res;
    }
}