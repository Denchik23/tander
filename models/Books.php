<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 *
 * @property BookAuthor[] $bookAuthors
 * @property Authors[] $authors
 */
class Books extends \yii\db\ActiveRecord
{
    public $idAuthors = array();
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'idAuthors'], 'required'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'idAuthors' => 'Авторы',
            'content' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Authors::className(), ['id' => 'author_id'])->viaTable('book_author', ['book_id' => 'id']);
    }


    /**
     * junction таблиц books и authors
     */
    protected function junctionBooksAuthors() {
        //Новые авторы
        $new_autrors = $this->idAuthors;

        //Текущий список авторов книги
        $current_author = array();
        foreach ($this->authors as $auth) {
            $current_author[] = $auth->id;
        }
        //Добавляем авторов
        foreach ($new_autrors as $authorN) {
            if (!in_array($authorN, $current_author)) {
                if ($author = Authors::findOne($authorN)) {
                    $this->link('authors', $author);
                }
            }
        }
        //Удаляем текущих
        foreach ($current_author as $authorC) {
            if (!in_array($authorC, $new_autrors)) {
                if ($author = Authors::findOne($authorC)) {
                    $this->unlink('authors', $author, true);
                }
            }
        }
    }


    /**
     * Переопределяем метод save для установки авторов книг
     * @param bool $runValidation
     * @param null $attributeNames
     * @return bool
     */
    public function save($runValidation = true, $attributeNames = null) {

        if (parent::save($runValidation, $attributeNames) !== false) {
            //Устанавливаем авторов книги
            $this->junctionBooksAuthors();
            return true;
        } else return false;
    }

}
