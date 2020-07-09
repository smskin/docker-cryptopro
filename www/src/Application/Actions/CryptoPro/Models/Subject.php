<?php
/** @noinspection PhpUnused */

namespace App\Application\Actions\CryptoPro\Models;

/**
 * Class Subject
 * @package App\Application\Actions\CryptoPro\Models
 *
 * @OA\Schema(
 *     title="Subject",
 *     description="Subject model",
 * )
 */
class Subject
{
    /**
     * @var string
     *
     * @OA\Property()
     */
    public $raw;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $G;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $SN;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $T;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $OU;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $CN;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $O;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $L;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $C;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $E;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $emailAddress;

    public function __construct(string $str)
    {
        $this->raw = $str;
        if (preg_match_all('~(emailAddress|E|C|L|O|CN|OU|T|SN|G)=([^,]*)~', $str . ',', $m)) {
            foreach ($m[1] as $idx => $key) {
                $this->$key = stripslashes($m[2][$idx]);
            }
        }
    }
}