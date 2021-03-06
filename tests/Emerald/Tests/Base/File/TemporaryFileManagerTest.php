<?php

namespace Emerald\Tests\Base\File;


class TemporaryFileManagerTest extends \Emerald\Tests\TestCase
{
    
    public function tearDown()
    {
        exec("rm -f " . ROOT_TESTS . '/data/temp/*');
    }
    
    
    public function testRegisterAndUnRegister()
    {
        $path = ROOT_TESTS . '/data/temp/foo.jpg';
        
        copy(ROOT_TESTS . '/data/self-lussing-manatee.jpg', $path);
                
        $manager = new \Emerald\Base\File\TemporaryFileManager();
        
        $this->assertFileExists($path);

        $manager->registerFile($path);
        
        $manager->unregisterFile($path);

        unset($manager);

        $this->assertFileExists($path);
                
        
    }

    
    
    public function testGetRegisteredFiles()
    {
        $path = ROOT_TESTS . '/data/temp/foo.jpg';
        $path2 = ROOT_TESTS . '/data/temp/foo-manchu.jpg';
                
        copy(ROOT_TESTS . '/data/self-lussing-manatee.jpg', $path);
        copy(ROOT_TESTS . '/data/self-lussing-manatee.jpg', $path2);
                
        $manager = new \Emerald\Base\File\TemporaryFileManager();
        
        $farray = array(
            ROOT_TESTS . '/data/temp/foo.jpg' => ROOT_TESTS . '/data/temp/foo.jpg',
            ROOT_TESTS . '/data/temp/foo-manchu.jpg' => ROOT_TESTS . '/data/temp/foo-manchu.jpg',
        );
        
        $path = ROOT_TESTS . '/data/temp/foo.jpg';
        $path2 = ROOT_TESTS . '/data/temp/foo-manchu.jpg';
                
        $this->assertEquals(array(), $manager->getRegisteredFiles());
        
        
        foreach($farray as $file) {
            $manager->registerFile($file);
        }
        
        $this->assertEquals($farray, $manager->getRegisteredFiles());

        foreach($farray as $file) {
            $manager->unregisterFile($file);
        }
        
        $this->assertEquals(array(), $manager->getRegisteredFiles());
        
    }
    
    
    public function testFlush()
    {
        $path = ROOT_TESTS . '/data/temp/foo.jpg';
        $path2 = ROOT_TESTS . '/data/temp/foo-manchu.jpg';
        
        copy(ROOT_TESTS . '/data/self-lussing-manatee.jpg', $path);
        copy(ROOT_TESTS . '/data/self-lussing-manatee.jpg', $path2);
                
        $manager = new \Emerald\Base\File\TemporaryFileManager();
        
        $this->assertFileExists($path);
        $this->assertFileExists($path2);
        
        $manager->registerFile($path);
        $manager->registerFile($path2);
        
        $manager->flush();
                
        $this->assertFileNotExists($path);
        $this->assertFileNotExists($path2);
        
        $this->assertEquals(array(), $manager->getRegisteredFiles());
        
    }
    
    
    
    
    public function testDestructorFlush()
    {
        $path = ROOT_TESTS . '/data/temp/foo.jpg';
        $path2 = ROOT_TESTS . '/data/temp/foo-manchu.jpg';
        
        copy(ROOT_TESTS . '/data/self-lussing-manatee.jpg', $path);
        copy(ROOT_TESTS . '/data/self-lussing-manatee.jpg', $path2);
                
        $manager = new \Emerald\Base\File\TemporaryFileManager();
        
        $this->assertFileExists($path);
        $this->assertFileExists($path2);
        
        $manager->registerFile($path);
        $manager->registerFile($path2);
        
        unset($manager);
        
        $this->assertFileNotExists($path);
        $this->assertFileNotExists($path2);
        
    }
    
    
    
    
    /**
     * 
     * @expectedException \Emerald\Base\File\FileException
     */
    public function testUnreadableRegister()
    {
         $manager = new \Emerald\Base\File\TemporaryFileManager();
         
         $manager->registerFile("/etc/passwd");
                  
         // Just to be sure :)
         $manager->unregisterFile("/etc/passwd");
         
    }
        
    /**
     * 
     * @expectedException \Emerald\Base\File\FileException
     */
    public function testInvalidRegister()
    {
        $manager = new \Emerald\Base\File\TemporaryFileManager();
         
        $manager->registerFile("/etc/lamantiini/manaatti/superlosoposki");
    }
    
    
    
}
