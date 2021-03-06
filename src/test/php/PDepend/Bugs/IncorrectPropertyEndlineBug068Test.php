<?php
/**
 * This file is part of PDepend.
 *
 * PHP Version 5
 *
 * Copyright (c) 2008-2015, Manuel Pichler <mapi@pdepend.org>.
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
 * @copyright 2008-2015 Manuel Pichler. All rights reserved.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

namespace PDepend\Bugs;

/**
 * Test case for bug 68 where the property end line of a property was not set
 * correct.
 *
 * http://tracker.pdepend.org/pdepend/issue_tracker/issue/68
 *
 * @copyright 2008-2015 Manuel Pichler. All rights reserved.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 *
 * @covers \stdClass
 * @group regressiontest
 */
class IncorrectPropertyEndlineBug068Test extends AbstractRegressionTest
{
    /**
     * Tests that the parser sets the expected start and end line for a property.
     *
     * @return void
     */
    public function testParserSetsExpectedStartAndEndLineForPropertyWithoutDefaultValue()
    {
        $property = self::parseCodeResourceForTest()
            ->current()
            ->getClasses()
            ->current()
            ->getProperties()
            ->current();

        $this->assertSame(5, $property->getStartLine());
        $this->assertSame(5, $property->getEndLine());
    }

    /**
     * Tests that the parser sets the expected start and end line for a property.
     *
     * @return void
     */
    public function testParserSetsExpectedStartAndEndLineForPropertyWithCommentsInDeclaration()
    {
        $property = self::parseCodeResourceForTest()
            ->current()
            ->getClasses()
            ->current()
            ->getProperties()
            ->current();

        $this->assertSame(9, $property->getStartLine());
        $this->assertSame(9, $property->getEndLine());
    }

    /**
     * Tests that the parser sets the expected start and end line for a property.
     *
     * @return void
     */
    public function testParserSetsExpectedStartAndEndLineForPropertyWithArrayDefaultValue()
    {
        $property = self::parseCodeResourceForTest()->current()
            ->getClasses()
            ->current()
            ->getProperties()
            ->current();

        $this->assertSame(3, $property->getStartLine());
        $this->assertSame(7, $property->getEndLine());
    }

    /**
     * Tests that the parser sets the expected start and end line for a property.
     *
     * @return void
     */
    public function testParserSetsExpectedStartAndEndLineForPropertyWithScalarDefaultValueAndComments()
    {
        $property = self::parseCodeResourceForTest()->current()
            ->getClasses()
            ->current()
            ->getProperties()
            ->current();

        $this->assertSame(8, $property->getStartLine());
        $this->assertSame(13, $property->getEndLine());
    }
}
