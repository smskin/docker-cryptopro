<?php

namespace App\Libraries\CryptoPro\CLI;

use App\Libraries\CryptoPro\CLI\Requests\SignRequest;
use App\Libraries\CryptoPro\CLI\Responses\SignResponse;
use Exception;

class CryptCP
{
    public $app = '/opt/cprocsp/bin/amd64/cryptcp';

    /**
     * @param SignRequest $request
     * @return SignResponse
     * @throws Exception
     */
    public function sign(SignRequest $request): SignResponse
    {
        $request->validate();

        exec($this->app . ' ' . $request->serialize(), $output);

        $this->checkResponseCode($output);
        return (new SignResponse)
            ->setMessage(implode(PHP_EOL, $output));
    }

    /**
     * @param array $output
     * @throws Exception
     */
    private function checkResponseCode(array $output): void
    {
        $errorCode = $this->getErrorCode($output);
        if (!$errorCode) {
            return;
        }

        throw new Exception(
            $this->getErrorMessageByCode($errorCode),
            $errorCode
        );
    }

    /**
     * Source: https://argos-nalog.ru/images/files/cryptopro_docs/CMD%20application%20CSP%204_0%20(00088-01%2093%2001).pdf
     * @param int $errorCode
     * @return string
     */
    private function getErrorMessageByCode(int $errorCode): string
    {
        if ($errorCode === 536871012) {
            return 'Мало памяти';
        }
        if ($errorCode === 536871013) {
            return 'Не удалось открыть файл';
        }

        if ($errorCode === 536871014) {
            return 'Операция отменена пользователем';
        }

        if ($errorCode === 536871015) {
            return 'Некорректное преобразование BASE64';
        }

        if ($errorCode === 536871016) {
            return 'Если указан параметр \'-help\', то других быть не должно';
        }

        if ($errorCode === 536871112) {
            return 'Указан лишний файл';
        }

        if ($errorCode === 536871113) {
            return 'Указан неизвестный ключ';
        }

        if ($errorCode === 536871114) {
            return 'Указана лишняя команда';
        }

        if ($errorCode === 536871115) {
            return 'Для ключа не указан параметр';
        }

        if ($errorCode === 536871116) {
            return 'Не указана команда';
        }

        if ($errorCode === 536871117) {
            return 'Не указан необходимый ключ';
        }

        if ($errorCode === 536871118) {
            return 'Указан неверный ключ';
        }

        if ($errorCode === 536871119) {
            return 'Параметром ключа \'-q\' должно быть натуральное число';
        }

        if ($errorCode === 536871120) {
            return 'Не указан входной файл';
        }

        if ($errorCode === 536871121) {
            return 'Не указан выходной файл';
        }

        if ($errorCode === 536871122) {
            return 'Команда не использует параметр с именем файла';
        }

        if ($errorCode === 536871123) {
            return 'Не указан файл сообщения';
        }

        if ($errorCode === 536871212) {
            return 'Не удалось открыть хранилище сертификатов';
        }

        if ($errorCode === 536871213) {
            return 'Сертификаты не найдены';
        }

        if ($errorCode === 536871214) {
            return 'Найдено более одного сертификата (ключ \'-1\')';
        }

        if ($errorCode === 536871215) {
            return 'Команда подразумевает использование только одного сертификата';
        }

        if ($errorCode === 536871216) {
            return 'Неверно указан номер';
        }

        if ($errorCode === 536871217) {
            return 'Нет используемых сертификатов';
        }

        if ($errorCode === 536871218) {
            return 'Данный сертификат не может применяться для этой операции';
        }

        if ($errorCode === 536871219) {
            return 'Цепочка сертификатов не проверена';
        }

        if ($errorCode === 536871220) {
            return 'Криптопровайдер, поддерживающий необходимый алгоритм не найден';
        }

        if ($errorCode === 536871221) {
            return 'Неудачный ввод пароля ключевого контейнера';
        }

        if ($errorCode === 536871312) {
            return 'Не указана маска файлов';
        }

        if ($errorCode === 536871313) {
            return 'Указаны несколько масок файлов';
        }

        if ($errorCode === 536871314) {
            return 'Файлы не найдены';
        }

        if ($errorCode === 536871315) {
            return 'Задана неверная маска';
        }

        if ($errorCode === 536871316) {
            return 'Неверное значение хэш-функции';
        }

        if ($errorCode === 536871412) {
            return 'Ключ \'-start\' указан, а выходной файл нет';
        }

        if ($errorCode === 536871413) {
            return 'Содержимое файла - не подписанное сообщение';
        }

        if ($errorCode === 536871414) {
            return 'Неизвестный алгоритм подписи';
        }

        if ($errorCode === 536871415) {
            return 'Сертификат автора подписи не найден';
        }

        if ($errorCode === 536871416) {
            return 'Подпись не найдена';
        }

        if ($errorCode === 536871417) {
            return 'Подпись не верна';
        }

        if ($errorCode === 536871418) {
            return 'Штамп времени не верен';
        }

        if ($errorCode === 536871512) {
            return 'Содержимое файла - не зашифрованное сообщение';
        }

        if ($errorCode === 536871513) {
            return 'Неизвестный алгоритм шифрования';
        }

        if ($errorCode === 536871514) {
            return 'Не найден сертификат с соответствующим секретным ключом';
        }

        if ($errorCode === 536871612) {
            return 'Не удалось инициализировать COM';
        }

        if ($errorCode === 536871613) {
            return 'Контейнеры не найдены';
        }

        if ($errorCode === 536871614) {
            return 'Не удалось получить ответ от сервера';
        }

        if ($errorCode === 536871615) {
            return 'Сертификат не найден в ответе сервера';
        }

        if ($errorCode === 536871616) {
            return 'Файл не содержит идентификатор запроса';
        }

        if ($errorCode === 536871617) {
            return 'Некорректный адрес ЦС';
        }

        if ($errorCode === 536871618) {
            return 'Получен неверный Cookie';
        }

        if ($errorCode === 536871712) {
            return 'Серийный номер содержит недопустимое количество символов';
        }

        if ($errorCode === 536871713) {
            return 'Неверный код продукта';
        }

        if ($errorCode === 536871714) {
            return 'Не удалось проверить серийный номер';
        }

        if ($errorCode === 536871715) {
            return 'Не удалось сохранить серийный номер';
        }

        if ($errorCode === 536871716) {
            return 'Не удалось загрузить серийный номер';
        }

        if ($errorCode === 536871717) {
            return 'Лицензия просрочена';
        }

        if ($errorCode === 3255828769) {
            return 'Error: The URL of TSP service is not specified';
        }

        return 'Unknown error (' . $errorCode . ')';
    }

    private function getErrorCode(array $output): int
    {
        foreach ($output as $line) {
            /** @noinspection RegExpRedundantEscape */
            if (preg_match('/\[ErrorCode: (.*)\]/i', $line, $matches)) {
                return hexdec($matches[1]);
            }
        }
        return -1;
    }
}