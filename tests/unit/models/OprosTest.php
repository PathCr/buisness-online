<?php

namespace app\tests\unit\models;

use app\models\Opros;
use app\models\OprosOptions;
use Codeception\PHPUnit\TestCase;

class OprosTest extends TestCase
{
    protected function _before()
    {
        // Здесь можно подготовить данные перед каждым тестом
    }

    public function testCreateOpros()
    {
        $opros = new Opros();
        $opros->question1 = 'Как часто вы посещаете аптеки?';
        $opros->question2 = 'Как часто вы употребляете пиво?';
        $opros->question3 = 'Считаете ли вы употребление пива вредным для здоровья?';
        $opros->question4 = 'Какие меры вы обычно принимаете для облегчения похмельного синдрома?';
        $opros->question5 = 'Какие средства от похмелья вы обычно покупаете?';
        $opros->question6 = 'Где вы обычно покупаете средства от похмелья?';
        $opros->question8 = 'Готовы ли вы получать консультации в аптеке?';
        $opros->question9 = 'Насколько вы доверяете информации о здоровье, которую предоставляет фармацевт?';
        $opros->question10 = 'Как вы считаете, уместно ли продавать в аптеке товары, связанные с алкоголем?';
        $opros->question11 = 'Ваш пол';
        $opros->question12 = 30;

        // Проверяем, что опрос успешно сохраняется
        $this->assertTrue($opros->save(), 'Опрос не был сохранен: ' . implode(', ', $opros->getFirstErrors()));
    }

    public function testGetOptionsForQuestion()
    {
        // Предполагаем, что у вас есть опции в базе данных для вопроса с ID 1
        $options = OprosOptions::getOptionsForQuestion(1);

        // Проверяем, что опции возвращаются и не пусты
        $this->assertNotEmpty($options, 'Опции для вопроса не найдены');
    }
}