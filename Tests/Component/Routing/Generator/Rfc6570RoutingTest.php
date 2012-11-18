<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\FrameworkBundle\Tests\Routing;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * @author Baldur Rensch <baldur.rensch@hautelook.com>
 */
class Rfc6570RoutingTest extends \PHPUnit_Framework_TestCase
{
    public function testSimplePlaceholder()
    {
        $routes = new RouteCollection();

        $routes->add('foo', new Route(
            '/foo/{foo}/',
            array(
                'foo'    => '123',
            ),
            array(
            )
        ));

        $sc = $this->getServiceContainer($routes);

        $router = new Router($sc, 'foo',
            array(
                'generator_class' => 'Hautelook\\TemplatedUriBundle\\Component\\Routing\\Generator\\Rfc6570Generator',
            )
        );
        $generatedRoute = $router->generate('foo', array('foo' => 'foobar', 'bar' => 'barbar'));

        $this->assertEquals(
            "/foo/foobar/?{&bar}",
            $generatedRoute
        );
    }

    public function testArrayPlaceholder()
    {
        $routes = new RouteCollection();

        $routes->add('foo', new Route(
            '/foo/{foo}/',
            array(
                'foo'    => '123',
            ),
            array(
            )
        ));

        $sc = $this->getServiceContainer($routes);

        $router = new Router($sc, 'foo',
            array(
                'generator_class' => 'Hautelook\\TemplatedUriBundle\\Component\\Routing\\Generator\\Rfc6570Generator',
            )
        );
        $generatedRoute = $router->generate('foo', array('foo' => 'foobar', 'bar' => array()));

        $this->assertEquals(
            "/foo/foobar/?{&bar%5B%5D*}",
            $generatedRoute
        );
    }

    private function getServiceContainer(RouteCollection $routes)
    {
        $loader = $this->getMock('Symfony\Component\Config\Loader\LoaderInterface');

        $loader
            ->expects($this->any())
            ->method('load')
            ->will($this->returnValue($routes))
        ;

        $sc = $this->getMock('Symfony\\Component\\DependencyInjection\\ContainerInterface');

        $sc
            ->expects($this->once())
            ->method('get')
            ->will($this->returnValue($loader))
        ;

        return $sc;
    }
}
