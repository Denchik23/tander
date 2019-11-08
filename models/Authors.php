<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $dob
 *
 * @property BookAuthor[] $bookAuthors
 * @property Books[] $books
 */
class Authors extends \yii\db\ActiveRecord
{
    public $countBooks;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['dob'], 'safe'],
            [['dob'], 'date', 'format' => 'yyyy-MM-dd'],
            [['name'], 'string', 'max' => 20],
            [['surname'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'dob' => 'Дата рождения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['id' => 'book_id'])->viaTable('book_author', ['author_id' => 'id']);
    }


    public function setCountBooks() {
        $this->countBooks = count($this->books);
        return $this->countBooks;
    }
}
