<?php
/**
 * Created by IntelliJ IDEA.
 * User: zfm
 * Date: 2018/12/17
 * Time: 5:39 PM
 */

namespace Ahaschool\Swagger;

if (! function_exists('Ahaschool\Swagger\scan')) {

    /**
     * 构建swagger json
     * @param string $directory
     * @return array
     */
    function scan(string $directory)
    {
        $classNames = ClassName::getClassNamesByPath($directory);
        $docs = DocComment::getDocCommentByClass($classNames);
        $docs['definitions'] = Builder::buildDefinitions($docs['definitions']);
        $docs['paths'] = Builder::buildPaths($docs['paths']);
        return $docs;
    }
}
