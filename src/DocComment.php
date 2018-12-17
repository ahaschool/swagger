<?php
/**
 * Created by IntelliJ IDEA.
 * User: zfm
 * Date: 2018/12/17
 * Time: 5:30 PM
 */

namespace Ahaschool\Swagger;


class DocComment
{
    /**
     * 使用反射class读取注释
     * @param array $classNames
     * @return array
     */
    public static function getDocCommentByClass(array $classNames)
    {
        $docs = ['paths' => [], 'definitions' => []];
        foreach ($classNames as $className) {
            $reflection = new \ReflectionClass($className);
            $doc_str = $reflection->getDocComment();
            $doc = self::analysisDoc($doc_str);
            if (stripos($doc_str, '@swg\path')) {
                array_push($docs['paths'], $doc);
            }
            if (stripos($doc_str, '@swg\definition')) {
                array_push($docs['definitions'], $doc);
            }
            $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);
            foreach ($methods as $method) {
                $doc_str = $method->getDocComment();
                $doc = self::analysisDoc($doc_str);
                if (stripos($doc_str, '@swg\path')) {
                    array_push($docs['paths'], $doc);
                }
                if (stripos($doc_str, '@swg\definition')) {
                    array_push($docs['definitions'], $doc);
                }
            }
        }
        return $docs;
    }

    /**
     * 解析注释字符串
     * @param string $doc
     * @return array|null|string|string[]
     */
    private static function analysisDoc(string $doc)
    {
        $doc = preg_replace('/[ \t]*\\/\*\*/', '', trim($doc));
        $doc = preg_replace('/\*\/[ \t]*$/', '', trim($doc));
        $doc = preg_replace('/^[ \t]*\*/', '', trim($doc));
        $doc = explode('*', trim($doc));
        foreach ($doc as $k => &$item) {
            if (stripos($item, '@') === false) {
                array_splice($doc, $k, 1);
            } else {
                $item = trim($item);
                $item = preg_replace("/\s(?=\s)/", "\\1", $item);
            }
        }
        return $doc;
    }
}
