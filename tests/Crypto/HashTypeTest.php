<?php declare(strict_types=1);

namespace Tests\Mediagone\Doctrine\Common\Types\Crypto;

use Doctrine\DBAL\Platforms\MySqlPlatform;
use Doctrine\DBAL\Platforms\PostgreSQL94Platform;
use Doctrine\DBAL\Types\Type;
use Mediagone\Common\Types\Crypto\Hash;
use Mediagone\Common\Types\Crypto\HashBcrypt;
use Mediagone\Doctrine\Common\Types\Crypto\HashType;
use PHPUnit\Framework\TestCase;


/**
 * @covers \Mediagone\Doctrine\Common\Types\Crypto\HashType
 */
final class HashTypeTest extends TestCase
{
    //========================================================================================================
    // Properties
    //========================================================================================================
    
    private HashType $type;
    
    
    
    //========================================================================================================
    // Initialization
    //========================================================================================================
    
    public static function setUpBeforeClass() : void
    {
        if (!Type::hasType(HashType::NAME)) {
            Type::addType(HashType::NAME, HashType::class);
        }
    }
    
    
    public function setUp() : void
    {
        $this->type = Type::getType(HashType::NAME);
    }
    
    
    
    //========================================================================================================
    // Tests
    //========================================================================================================
    
    public function test_can_return_its_name() : void
    {
        self::assertSame(HashType::NAME, $this->type->getName());
    }
    
    
    public function test_requires_comment_hint() : void
    {
        self::assertTrue($this->type->requiresSQLCommentHint(new MySqlPlatform()));
        self::assertTrue($this->type->requiresSQLCommentHint(new PostgreSQL94Platform()));
    }
    
    
    public function test_declare_sql() : void
    {
        self::assertSame('CHAR(60)', $this->type->getSQLDeclaration([], new MySqlPlatform()));
        self::assertSame('CHAR(60)', $this->type->getSQLDeclaration(['length' => '200'], new MySqlPlatform()));
    }
    
    
    public function test_can_convert_to_database_value() : void
    {
        $hash = '$2y$12$00000000000000000000000000000000000000000000000000000';
        $bcrypt = Hash::fromHash($hash);
        $value = $this->type->convertToDatabaseValue($bcrypt, new MySqlPlatform());
        
        self::assertSame($hash, $value);
    }
    
    
    public function test_can_convert_value_from_database() : void
    {
        $value = '$2y$12$00000000000000000000000000000000000000000000000000000';
        $bcrypt = $this->type->convertToPHPValue($value, new MySqlPlatform());
        
        self::assertInstanceOf(Hash::class, $bcrypt);
        self::assertSame($value, $bcrypt->toString());
    }
    
    
    
}
