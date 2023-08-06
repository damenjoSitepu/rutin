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
| `addDay()`   | Add one day to your specific **DateTime** | 
| `subDay()`   | Substract one day to your specific **DateTime** | 
| `addDays(int $numberOfDays)` | Add **N** days to your specific **DateTime** |
| `addDayIf(callable $prediction)` | Add one day to your specific **DateTime** with certain condition |
| `subDayIf(callable $prediction)` | Substract one day to your specific **DateTime** with certain condition |
| `addDaysIf(callable $prediction, int $numberOfDays)` | Add **N** days to your specific **DateTime** with certain condition |
| `addMonth()`   | Add one month to your specific **DateTime** | 
| `addMonths(int $numberOfMonths)` | Add **N** months to your specific **DateTime** |
| `addMonthIf(callable $prediction)` | Add one month to your specific **DateTime** with certain condition |
| `addMonthsIf(callable $prediction, int $numberOfMonths)` | Add **N** months to your specific **DateTime** with certain condition |
| `addYear()`   | Add one year to your specific **DateTime** | 
| `addYears(int $numberOfYears)` | Add **N** years to your specific **DateTime** |
| `addYearIf(callable $prediction)` | Add one year to your specific **DateTime** with certain condition |
| `addYearsIf(callable $prediction, int $numberOfYears)` | Add **N** years to your specific **DateTime** with certain condition |
| `addTimestamp(int $numberOfTimestamp = 1)`   | Add defined number of timestamp to your specific **DateTime** | 
| `addTimestampIf(callable $prediction, int $numberOfTimestamp = 1)` | Add defined number of timestamp to your specific **DateTime** with certain condition |

> [!NOTE]
> We also now have `add(string $dateElement, int $numberOfDateElement = 1)` or `skip(string $dateElement, int $numberOfDateElement = 1)` to make your life easier. We'll describe the example below the existing code, so please take your time to see it ^_^

This is a few example how to use all the listed method above: 

```php
// 2023-08-04
$rutin = Rutin::now()->add("day",1)->format("Y-m-d");

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
> `null` or any type unless `number` will cause an error, so please take a **note** that `try` and `catch` blocks are  important to handle the error of your code. For some quick step, lets see this code:

```php
try {
    // Invalid argument data type
    $rutinNull = Rutin::now()->addDays("")->format("Y-m-d");
} catch (\Damenjo\Rutin\Exceptions\RutinException $e) {
    // We recommend you to use this catch blocks too
    echo $e->ruinMessage();
} catch (\TypeError $e) {
    // Do whatever you want inside this block
}
```

Also, if you have scenario like to add your day by some conditions, you can use `addDayIf()` . 

```php
$prediction = true;
$rutinPlusOneDayIf = Rutin::now()->addDayIf(fn() => $prediction)->format("Y-m-d");
```

Certainly, there is a scenario that make you need to use condition within the `add()` method. That is now possible to do with our brand new `while()` . 

```php
$prediction = true;
Rutin::now()->while(fn() => $prediction)->add("month",3)->format("Y-m-d");
```

Since this method was calling in front of addition or substraction method like `addDay()` or `addMonths()` , `etc` , this awesome `while()` method will determine that addition or substraction functionality will be affected to the current **DateTime** or not.

> [!WARNING]
> `while()` only will affect to addition or substraction datetime method, not another things like `format()`

---

**License**: [MIT](https://opensource.org/license/mit/)

