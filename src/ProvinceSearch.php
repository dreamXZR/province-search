<?php

namespace Dreamxzr\ProvinceSearch;


use Dreamxzr\ProvinceSearch\Exceptions\InvalidArgumentException;
use Dreamxzr\ProvinceSearch\Models\Position;

class ProvinceSearch
{
    /**
     * 返回省的数据
     * @param string $query  查询条件
     * @param string $format 返回类型
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function getProvince($query='',$format='json')
    {

        if (!\in_array(\strtolower($format), ['array', 'json'])) {
            throw new InvalidArgumentException('Invalid response format: '.$format);
        }

        if(empty($query)){
            $format_query=['level'=>1];
        }else{
            if(is_numeric($query)){
                $format_query=['area_code'=>$query];
            }else{
                $format_query=['area_name'=>$query];
            }
        }

        $resource=$this->getProvinceInfo($format_query);

        return $this->formatResource($resource,$format);

    }

    /**
     * 返回市的数据
     * @param string $query 查询条件
     * @param string $format 返回类型
     * @return mixed
     */
    public function getCity($query='',$format='json')
    {
        if (!\in_array(\strtolower($format), ['array', 'json'])) {
            throw new InvalidArgumentException('Invalid response format: '.$format);
        }

        if(is_numeric($query)){
            $resource=$this->getCityByInt($query);
        }else{
            $resource=$this->getCityByString($query);
        }

        return $this->formatResource($resource,$format);
    }

    protected function getProvinceInfo(array $query)
    {
        return $resource=Position::where($query)->get();
    }

    protected function getCityByInt($query)
    {
        $position=Position::where(['area_code'=>$query])->first();

        if($position){
            switch ($position->level){
                case 1:
                    return $position->getChild()->get();
                    break;
                case 2:
                    return $position;
                    break;
                case 3:
                    break;
            }
        }

    }

    protected function getCityByString($query)
    {
        $position=Position::where(['area_name'=>$query])->first();

        if($position){
            switch ($position->level){
                case 1:
                    return $position->getChild()->get();
                    break;
                case 2:
                    return $position;
                    break;
                case 3:
                    break;
            }
        }

    }

    protected function formatResource($resource,$format)
    {
        switch ($format){
            case 'array':
                return $this->toArray($resource);
                break;
            case 'json':
                return $this->toJson($resource);
                break;
        }
    }

    /**
     * 返回查询后的json数据
     * @param $resource 查询结果
     * @return mixed
     */
    protected function toJson($resource)
    {
        return $resource->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * 返回查询后的array数据
     * @param $resource
     * @return mixed
     */
    protected function toArray($resource)
    {
        return $resource->toArray();
    }
}