<?php
/**
 * Created by PhpStorm.
 * User: Кузнецо
 * Date: 08.04.2017
 * Time: 17:13
 */

namespace KaaMailLib\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Класс отвечат за внедрение сервисов в консюмеры
 *
 * Class DiSetter
 * @package KaaMailLib\Services
 */
class DiSetter
{
    /**
     * Контэйнер описанный в классе DiSetter
     *
     * @var ContainerInterface
     */
    private $container;

    /**
     * Загрузка контейнера
     *
     * @param ContainerInterface $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    /**
     * Загружает в класс сервимы которые описаны в контэйнере
     *
     * @param $callback
     * @return bool
     */
    public function setServicesToClass($callback)
    {
        if (class_exists($callback)) {
            $consumer = new $callback;
            $reflection = new \ReflectionClass($consumer);
            $setters = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PRIVATE);
            foreach($setters as $setter) {
                $camelSetter = ucfirst ($setter->name);
                if (method_exists($consumer, "set$camelSetter")) {
                    $snakeCase = ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $camelSetter)), '_');
                    if ($this->container->has($camelSetter)) {
                        $service = $this->container->get($camelSetter);
                        $reflectionMethod = new \ReflectionMethod($consumer, "set$camelSetter");
                        $reflectionMethod->invokeArgs($consumer, array($service));
                    } elseif ($this->container->has($snakeCase)) {
                        $service = $this->container->get($snakeCase);
                        $reflectionMethod = new \ReflectionMethod($consumer, "set$camelSetter");
                        $reflectionMethod->invokeArgs($consumer, array($service));
                    }
                }
            }
            return $consumer;
        }
        return false;
    }
}
