## Rutin Provide Great PHP API Extension For DateTime Services :+1:
### Installation List

You can install this package via:

| Dependency Manager | Command |
| --------------- | --------------- |
| [Composer](https://getcomposer.org/)   | ```composer require damenjo/rutin```  |

### Guidelines

You may get the current date and time just only using our `now()` method. Here's the example below: 

```php
use Damenjo\Rutin\Main\Rutin;
// 2023-08-03 20:39:45
$now = Rutin::now()->format();
```

By default, our package will recognized this **DateTime** format as `Y-m-d H:i:s` . If you need to define the specific timezone as well, you can set the first argument directly to the `now()` method like this:

```php 
$now = Rutin::now("Asia/Jakarta")->format();
```

If you need to specified another **DateTime** format, you may also set the first argument for `format()` method. Here's the way to do that:

```php
// 2023-08-03
$date = Rutin::now("Asia/Jakarta")->format("Y-m-d");
// 20:39:45
$time = Rutin::now("Asia/Jakarta")->format("H:i:s");
// 2023
$year = Rutin::now("Asia/Jakarta")->format("Y");
```

**Note**: All **DateTime** keyword format was referred to [PHP DateTime Format](https://www.php.net/manual/en/datetime.format.php) documentations.

We also have method that can help you to add or substract `days`, `month`, `year`, etc as many as you want. The list of utilities that you can use will be described below:

| Method Name | Used For |
| --------------- | --------------- |
| `addDay()`   | Add one day from your specific **DateTime** | 
| `addDays(int $numberOfDays)` | Add **N** days from your specific **DateTime** |

This is a few example how to use all the listed method above: 

```php
// 2023-08-03
$rutinNow = Rutin::now()->format("Y-m-d");

// 2023-08-04
$rutinPlusOneDay = Rutin::now()->addDay()->format("Y-m-d");

// 2023-08-05
$rutinPlusTwoDay = Rutin::now()->addDays(2)->format("Y-m-d");

// 2023-08-03
$rutinNull = Rutin::now()->addDays(null ?? 0)->format("Y-m-d");
```
> [!WARNING]
> Null will cause an **error**, please take a **note** that null safety `??` are **important** if you not sure that value will be taken as `number`

---

**License**: [MIT](https://opensource.org/license/mit/)

