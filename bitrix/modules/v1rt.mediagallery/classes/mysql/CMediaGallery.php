<?
namespace V1rt\Media;

class CMediaGallery
{
    public static function collections()
    {
        global $DB;
        $results = array();
        $sql = "SELECT ID, NAME FROM b_medialib_collection WHERE ID > 0 AND ACTIVE = 'Y' AND ML_TYPE = '1'";
        $res = $DB->Query($sql);
        while($g = $res->Fetch())
            $results[$g["ID"]] = $g["NAME"];
        return $results;
    }
    
    public static function listCollections($parent = null)
    {
        global $DB;
        $results = array();
        if(is_null($parent))
            $sql = "SELECT * FROM b_medialib_collection WHERE ID > 0 AND ACTIVE = 'Y' AND ML_TYPE = '1'";
        else
            $sql = "SELECT * FROM b_medialib_collection WHERE ID > 0 AND ACTIVE = 'Y' AND ML_TYPE = '1' AND PARENT_ID = '".intval($parent)."'";
        
        $res = $DB->Query($sql);
        while($g = $res->Fetch())
            $results[] = $g;
        return $results;
    }
    
    public static function countImages($parent)
    {
        global $DB;
        $sql = "SELECT COUNT(ITEM_ID) as COUNT_IMAGES FROM b_medialib_collection_item WHERE COLLECTION_ID = '".intval($parent)."'";
        $res = $DB->Query($sql);
        if($count = $res->Fetch())
            return $count["COUNT_IMAGES"];
        else
            return 0;
    }
    
    public static function getNameCollection($id)
    {
        global $DB;
        $name = "";
        if(is_numeric($id) && $id)
        {
            $sql = "SELECT NAME FROM b_medialib_collection WHERE ID = $id";
            $res = $DB->Query($sql);
            if($n = $res->Fetch())
                $name = $n["NAME"];
        }
        return $name;
    }
    
    public static function getCollection($id)
    {
        global $DB;
        $collection = array();
        if(is_numeric($id) && $id)
        {
            $sql = "SELECT * FROM b_medialib_collection WHERE ID = $id";
            $res = $DB->Query($sql);
            if($n = $res->Fetch())
                $collection = $n;
        }
        return $collection;
    }
    
    public static function bc($id, array $bc = array())
    {
        $collection = CMediaGallery::getCollection($id);
        $bc[] = $collection;
        if(is_numeric($collection["PARENT_ID"]) && $collection["PARENT_ID"])
        {
            return CMediaGallery::bc($collection["PARENT_ID"], $bc);
        }
        else
        {
            $_ = array();
            $c = count($bc);
            for($i = $c - 1; $i >= 0; $i--)
                $_[] = $bc[$i];
            return $_;
        }
    }
    
    public static function getImagesCollection(array $ids, $count = null, $rand = false)
    {
        global $DB;
        $sql_1 = "SELECT ITEM_ID FROM b_medialib_collection_item WHERE COLLECTION_ID = ".$ids[0];
        if(($c = count($ids)) > 1)
            for($i = 1; $i < $c; $i++)
                $sql_1 .= " OR COLLECTION_ID = '".$ids[$i]."'";
        
        //Вытаскиваем ID файлов из таблицы b_file
        if(!$rand)
        {
            if(is_numeric($count) && $count)
                $sql_2 = "SELECT SOURCE_ID, DESCRIPTION FROM b_medialib_item WHERE ID IN (".$sql_1.") LIMIT ".$count;
            else
                $sql_2 = "SELECT SOURCE_ID, DESCRIPTION FROM b_medialib_item WHERE ID IN (".$sql_1.")";
        }
        else
        {
            if(is_numeric($count) && $count)
                $sql_2 = "SELECT SOURCE_ID,NAME FROM b_medialib_item WHERE ID IN (".$sql_1.") ORDER BY RAND() LIMIT ".$count;
            else
                $sql_2 = "SELECT SOURCE_ID,NAME FROM b_medialib_item WHERE ID IN (".$sql_1.") ORDER BY RAND()";
        }
        
        return $DB->Query($sql_2);
    }
}
?>