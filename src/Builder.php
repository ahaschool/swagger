<?php
/**
 * Created by IntelliJ IDEA.
 * User: zfm
 * Date: 2018/12/17
 * Time: 5:36 PM
 */

namespace Ahaschool\Swagger;


class Builder
{
    /**
     * 构建paths参数
     * @param array $paths
     * @return array
     */
    public static function buildPaths(array $paths)
    {
        $res_paths = [];
        foreach ($paths as $path) {
            $path_name = [];
            $path_content = [];
            foreach ($path as $item) {
                if (stripos($item, '@swg\path') !== false) {
                    $item = explode(' ', $item);
                    $path_name[$item[2]] = [$item[1] => &$path_content];
                } elseif (stripos($item, '@swg\tags') !== false) {
                    $item = trim(str_replace('@swg\tags', '', $item));
                    $path_content['tags'] = json_decode($item, true);
                } elseif (stripos($item, '@swg\summary') !== false) {
                    $item = trim(str_replace('@swg\summary', '', $item));
                    $path_content['summary'] = $item;
                } elseif (stripos($item, '@swg\description') !== false) {
                    $item = trim(str_replace('@swg\description', '', $item));
                    $path_content['description'] = $item;
                } elseif (stripos($item, '@swg\produces') !== false) {
                    $item = trim(str_replace('@swg\produces', '', $item));
                    $path_content['produces'] = $item;
                } elseif (stripos($item, '@swg\req\param') !== false) {
                    $item = trim(str_replace('@swg\req\param', '', $item));
                    if (empty($path_content['parameters'])) {
                        $path_content['parameters'] = json_decode($item, true);
                    } else {
                        $path_content['parameters'] = array_merge($path_content['parameters'], json_decode($item, true));
                    }
                } elseif (stripos($item, '@swg\req\schema') !== false) {
                    $item = trim(str_replace('@swg\req\schema', '', $item));
                    if (empty($path_content['parameters']['schema']['properties'])) {
                        $path_content['parameters']['schema']['properties'] = [];
                    }
                    array_push($path_content['parameters']['schema']['properties'], json_decode($item, true));
                } elseif (stripos($item, '@swg\res\schema') !== false) {
                    $item = trim(str_replace('@swg\res\schema', '', $item));
                    if (empty($path_content['responses']['200'])) {
                        $path_content['responses']['200'] = [
                            "description" => "响应成功",
                            "schema" => ["properties" => []],
                        ];
                    }
                    array_push($path_content['responses']['200']['schema']['properties'], json_decode($item, true));
                }
            }
            $res_paths[] = $path_name;
        }

        return $res_paths;
    }

    /**
     * 构建Definitions参数
     * @param array $definitions
     * @return array
     */
    public static function buildDefinitions(array $definitions)
    {
        $def = [];
        foreach ($definitions as $definition) {
            $properties = [];
            $def_name = 'property';
            foreach ($definition as $item) {
                if (stripos($item, '@swg\definition') !== false) {
                    $name = explode(' ', $item);
                    $def_name = $name[1] ?? '';
                } elseif (stripos($item, '@property') !== false) {
                    $property_arr = explode(' ', $item);
                    $property = $property_arr[2] ?? '';
                    $property = str_replace('$', '', $property);
                    $properties = [$property => [
                        'type' => $property_arr[1],
                        'description' => $property_arr[3] ?? $property,
                    ]];
                }
            }
            $def[$def_name] = ['properties' => $properties];
        }
        return $def;
    }
}