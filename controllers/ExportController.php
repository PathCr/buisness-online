<?php

namespace app\controllers;

use app\models\Opros;
use app\models\OprosOptions;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\User;
use Yii;

class ExportController extends Controller
{

    public const QUESTIONS = [
            'question1' => 'Как часто вы посещаете аптеки?',
            'question2' => 'Как часто вы употребляете пиво?',
            'question3' => 'Считаете ли вы употребление пива вредным для здоровья?',
            'question4' => 'Какие меры вы обычно принимаете для облегчения похмельного синдрома?',
            'question5' => 'Какие средства от похмелья вы обычно покупаете?',
            'question6' => 'Где вы обычно покупаете средства от похмелья?',
            'question8' => 'Готовы ли вы получать консультации в аптеке?',
            'question9' => 'Насколько вы доверяете информации о здоровье, которую предоставляет фармацевт?',
            'question10' => 'Как вы считаете, уместно ли продавать в аптеке товары, связанные с алкоголем?',
            'question11' => 'Ваш пол',
            'question12' => 'Ваш возраст',
    ];

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['admin'],
                    ]
                ],
            ],
        ];
    }

    public function actionExportOpros()
    {
        if (!Yii::$app->user->can('admin')) {
            throw new \yii\web\ForbiddenHttpException('Доступ запрещен.');
        }

        $opros = Opros::find()->all();

        $spreadSheet = new Spreadsheet();
        $sheet = $spreadSheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Вопрос');
        $sheet->setCellValue('B1', 'Ответ');

        $row = 2;

        foreach ($opros as $record) {
            foreach (self::QUESTIONS as $key => $question) {
                $sheet->setCellValue('A' . $row, $question);

                $answerId = $record->$key; // Получаем id ответа
                $answerText = OprosOptions::find()->where(['id' => $answerId])->one(); // Получаем текст ответа по id

                if ($answerText) {
                    $sheet->setCellValue('B' . $row, $answerText->option_text);
                } else {
                    $sheet->setCellValue('B' . $row, $record->$key);
                }

                $row++;
            }
        }




        // Устанавливаем заголовки для скачивания
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="survey_results.xlsx"');
        header('Cache-Control: max-age=0');

        // Создаем файл Excel
        $writer = new Xlsx($spreadSheet);
        $writer->save('php://output');
        exit;
    }

    public function actionExportUser($id)
    {
        if (!Yii::$app->user->can('admin')) {
            throw new \yii\web\ForbiddenHttpException('Доступ запрещен.');
        }

        // Получаем данные пользователя по ID
        $user = User::findOne($id);
        if (!$user) {
            throw new \yii\web\NotFoundHttpException('Пользователь не найден.');
        }

        // Здесь вы можете добавить логику для получения данных, которые нужно экспортировать
        // Например, если у вас есть модель Opros, вы можете получить опросы пользователя
        $opros = Opros::find()->where(['user_id' => $id])->all();

        $spreadSheet = new Spreadsheet();
        $sheet = $spreadSheet->getActiveSheet();

        // Устанавливаем заголовки
        $sheet->setCellValue('A1', 'Вопрос');
        $sheet->setCellValue('B1', 'Ответ');

        $row = 2;

        foreach ($opros as $record) {
            foreach (self::QUESTIONS as $key => $question) {
                $sheet->setCellValue('A' . $row, $question);

                $answerId = $record->$key; // Получаем id ответа
                $answerText = OprosOptions::find()->where(['id' => $answerId])->one(); // Получаем текст ответа по id

                if ($answerText) {
                    $sheet->setCellValue('B' . $row, $answerText->option_text);
                } else {
                    $sheet->setCellValue('B' . $row, $record->$key);
                }

                $row++;
            }
        }

        // Устанавливаем заголовки для скачивания
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="user_survey_results_' . $id . '.xlsx"');
        header('Cache-Control: max-age=0');

        // Создаем файл Excel
        $writer = new Xlsx($spreadSheet);
        $writer->save('php://output');
        exit;
    }

}