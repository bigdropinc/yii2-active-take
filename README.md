Active Take
===========
Provides your ActiveRecords and ActiveQuery with mechanism of raising error when record not found, not saved or validation failed

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist bigdropinc/yii2-active-take "*"
```

or add

```
"bigdropinc/yii2-active-take": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Please, try to remember how many times you make compare like this 
```
if(User::findOne($id) !== null){

}
```  
Or something like this
```
if($model->save()){

}
```
OOP best practice said that method should not return null. Much better raise an exception. 
But in many cases we really need to get null value without raising exceptions. But in many cases no... 
This extension brings you opportunity to raise and process ActiveRecordExceptions during the interaction with ActiveRecord methods in very simple way. 
It's can make your code much more simple, clear and readable. It will allowed you to remove ugly and routine compare with null. 

### Active Record

By using ```bigdropinc\take\ActiveRecordTrait``` into your ActiveRecord class you got this features:
* all method **"find"** methods will get the pair **"take"** method (*findOne - takeOne, findAll - takeAll*). 
If find method returns empty result, take method will raise an ```RecordNotFoundException```
* method **takeValidate** will raise ```RecordInvalidException``` if validate returns false
* method **takeSave** will raise ```RecordInvalidException``` if model has validation errors during save.
Also **takeSave** will raise ```RecordNotSavedException``` if model validations was passed but model saving returned false

### Active Query

By using ```bigdropinc\take\ActiveRecordTrait``` into your ActiveRecord class you got this features:
* method **takeOne** will behaves like method **one** but raise an ```RecordNotFoundException``` if nothing found
* method **takeAll** will behaves like method **all** but raise an ```RecordNotFoundException``` if nothing found

### Error Handler
 
To render 404 page while ```RecordNotFoundException``` was raising, you should modify your main config file:
```
'components' => [
        'errorHandler' => [
            'class' => 'bigdropinc\take\ErrorHandler'
        ],
    ],
```