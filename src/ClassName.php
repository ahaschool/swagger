<?php
/**
 * Created by IntelliJ IDEA.
 * User: zfm
 * Date: 2018/12/17
 * Time: 5:28 PM
 */

namespace Ahaschool\Swagger;


class ClassName
{
    /**
     * 根据文件路径获取类名称
     * @param string $path
     * @return array
     */
    public static function getClassNamesByPath(string $path)
    {
        $classNames = array_merge(
            glob($path . 'Models/*.php'),
            glob($path . 'Models/*/*.php'),
            glob($path . 'Http/Controllers/*/*Controller.php'),
            glob($path . 'Http/Controllers/*Controller.php')
        );
        foreach ($classNames as &$className) {
            $className = str_replace(base_path(), '', $className);
            $className = ucfirst(strchr(strstr($className, 'app'), '.', TRUE));
            $className = '\\' . str_replace('/', '\\', $className);
        }
        return $classNames;
    }
}
