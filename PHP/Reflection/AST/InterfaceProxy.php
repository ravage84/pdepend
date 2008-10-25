<?php
/**
 * This file is part of PHP_Reflection.
 * 
 * PHP Version 5
 *
 * Copyright (c) 2008, Manuel Pichler <mapi@pdepend.org>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Manuel Pichler nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category   PHP
 * @package    PHP_Reflection
 * @subpackage AST
 * @author     Manuel Pichler <mapi@pdepend.org>
 * @copyright  2008 Manuel Pichler. All rights reserved.
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    SVN: $Id$
 * @link       http://www.manuel-pichler.de/
 */

require_once 'PHP/Reflection/AST/ClassOrInterfaceProxy.php';
require_once 'PHP/Reflection/AST/InterfaceI.php';

/**
 * This class is a proxy for interface nodes. Instances of this class will be 
 * used whenever it is clear that the context node is an interface, but the 
 * source of this node (project or external library) is unclear. 
 *
 * @category   PHP
 * @package    PHP_Reflection
 * @subpackage AST
 * @author     Manuel Pichler <mapi@pdepend.org>
 * @copyright  2008 Manuel Pichler. All rights reserved.
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://www.manuel-pichler.de/
 */
class PHP_Reflection_AST_InterfaceProxy
       extends PHP_Reflection_AST_ClassOrInterfaceProxy
    implements PHP_Reflection_AST_InterfaceI
{
    /**
     * The creating node builder instance.
     *
     * @var PHP_Reflection_BuilderI $_builder
     */
    private $_builder = null;
    
    /**
     * Constructs a new class or interface proxy.
     *
     * @param PHP_Reflection_BuilderI $builder The creating node builder instance.
     * @param unknown_type $identifier
     */
    public function __construct(PHP_Reflection_BuilderI $builder, $identifier)
    {
        parent::__construct($builder, $identifier);
        
        $this->_builder = $builder;
    }
    
    /**
     * Returns an iterator with all {@link PHP_Reflection_AST_InterfaceI} nodes
     * that are a parent, parent parent etc. interface of this interface.
     *
     * @return PHP_Reflection_AST_Iterator
     */
    public function getParentInterfaces()
    {
        return $this->getRealSubject()->getParentInterfaces();
    }
    
    /**
     * Returns the real interface representation.
     *
     * @return PHP_Reflection_AST_InterfaceI
     */
    protected function getRealSubject()
    {
        return $this->_builder->findInterfaceSubject($this->getQualifiedName());
    }
}