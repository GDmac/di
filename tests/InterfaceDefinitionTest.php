<?php
declare(strict_types=1);

namespace Capsule\Di;

use stdClass;

class InterfaceDefinitionTest extends DefinitionTest
{
    public function testConstructorNotInterface()
    {
        $this->expectException(Exception\NotFound::CLASS);
        $this->expectExceptionMessage("Interface 'Capsule\Di\Fake\Foo' not found.");
        $definition = new InterfaceDefinition(Fake\Foo::CLASS);
    }

    public function testClass()
    {
        $definition = new InterfaceDefinition(Fake\FooInterface::CLASS);
        $definition->class(stdClass::CLASS);
        $this->assertInstanceOf(stdClass::CLASS, $this->actual($definition));
    }

    public function testFactory()
    {
        $definition = new InterfaceDefinition(Fake\FooInterface::CLASS);
        $definition->factory(function (Container $container) {
            return new stdClass();
        });
        $this->assertInstanceOf(stdClass::CLASS, $this->actual($definition));
    }

    public function testClass_notFound()
    {
        $definition = new InterfaceDefinition(Fake\FooInterface::CLASS);
        $this->expectException(Exception\NotFound::CLASS);
        $this->expectExceptionMessage("Class 'NoSuchClass' not found.");
        $definition->class('NoSuchClass');
    }

    public function testClass_notDefined()
    {
        $definition = new InterfaceDefinition(Fake\FooInterface::CLASS);
        $this->assertNotInstantiable($definition, [
            [
                Exception\NotDefined::CLASS,
                "Class/factory for interface definition 'Capsule\Di\Fake\FooInterface' not set.",
            ]
        ]);
    }
}
