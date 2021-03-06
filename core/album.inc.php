<?php

    function addAlbum($arr)
    {
        insert("album", $arr);
    }

    /**
     * 根据商品id得到商品图片
     * @param int $id
     * @return array
     */
    function getProImgById($id)
    {
        $sql = "select albumPath from elecpro where id={$id} limit 1";
        $row = fetchOne($sql);
        return $row;
    }

    /**
     * 根据商品id得到所有图片
     * @param int $id
     * @return array
     */
    function getProImgsById($id)
    {
        $sql = "select albumPath from elecpro where id={$id} ";
        $rows = fetchAll($sql);
        return $rows;
    }

    /**
     * 文字水印的效果
     * @param int $id
     * @return string
     */
    function doWaterText($id)
    {
        $rows = getProImgById($id);
        $arr=explode(',',$rows['albumPath']);
        foreach ($arr as $img) {
            $filename = "uploads/" . $img;
            waterText($filename);
        }
        $mes = "操作成功";
        return $mes;
    }

    /**
     *图片水印
     * @param int $id
     * @return string
     */
    function doWaterPic($id)
    {

        $rows = getProImgById($id);
        $arr=explode(',',$rows['albumPath']);
        foreach ($arr as $img) {
            $filename = "uploads/" . $img;
            waterPic($filename);
        }
        $mes = "操作成功";
        return $mes;
    }




