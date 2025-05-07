#!/usr/bin/env php
<?php
declare(strict_types=1);
// Задание 2: рефакторинг кода
// https://github.com/netology-code/bphp-2-homeworks/blob/master/004-functions/exercise-02.md

// Задание 3: улучшение менеджера списка покупок
// https://github.com/netology-code/bphp-2-homeworks/blob/master/004-functions/exercise-03.md

const OPERATION_EXIT = 0;
const OPERATION_ADD = 1;
const OPERATION_DELETE = 2;
const OPERATION_PRINT = 3;
const OPERATION_RENAME = 4;
const OPERATION_SET_QUANTITY = 5;

$operations = [
    OPERATION_EXIT => OPERATION_EXIT . '. Завершить программу.',
    OPERATION_ADD => OPERATION_ADD . '. Добавить товар в список покупок.',
    OPERATION_DELETE => OPERATION_DELETE . '. Удалить товар из списка покупок.',
    OPERATION_PRINT => OPERATION_PRINT . '. Отобразить список покупок.',
    OPERATION_RENAME => OPERATION_RENAME . '. Переименовать товар из списка покупок.',
    OPERATION_SET_QUANTITY => OPERATION_SET_QUANTITY . '. Указать количество единиц товара.'
];

$items = [];
$quantities = [];

function clearScreen(): void {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        system('cls');
    } else {
        system('clear');
    }
}

function enterToContinue(): void {
    echo 'Нажмите enter для продолжения';
    fgets(STDIN);
}

function addToBasket(array &$items): void {
    global $quantities;
    echo "Введите название товара для добавления в список: \n> ";
    $itemName = trim(fgets(STDIN));
    $key = array_search($itemName, $items, true);
    if ($key === false) {
        $items[] = $itemName;
        unset($quantities[$itemName]);
    } else {
        echo "Нельзя добавить товар в список повторно.\n";
        enterToContinue();
    }
}

function deleteFromBasket(array &$items): void {
    printBasket($items);
    echo 'Введите название товара для удаления из списка:' . PHP_EOL . '> ';
    $itemName = trim(fgets(STDIN));

    $key = array_search($itemName, $items, true);
    if ($key === false) {
        echo "Товара с таким наименованием нет в списке.\n";
        enterToContinue();
    } else {
        unset($items[$key]);
    }
}

function renameItem(array &$items): void {
    global $quantities;
    printBasket($items);
    echo "Введите название товара для переименования:\n> ";
    $itemName = trim(fgets(STDIN));

    $key = array_search($itemName, $items, true);
    if ($key === false) {
        echo "Товара с таким наименованием нет в списке.\n";
        enterToContinue();
    } else {
        echo "Введение нового названия для $itemName:\n> ";
        $newItemName = trim(fgets(STDIN));
        if (array_search($newItemName, $items, true) !== false) {
            echo "Товар с таким именем уже есть в списке.\n";
            enterToContinue();
        } else {
            $items[$key] = $newItemName;
            if (isset($quantities[$newItemName])) {
                unset($quantities[$newItemName]);
            }
            if (isset($quantities[$itemName])) {
                $quantities[$newItemName] = $quantities[$itemName];
                unset($quantities[$itemName]);
            }
        }
    }
}

function setQuantityForItem(array &$items): void {
    global $quantities;
    printBasket($items);
    echo 'Введите название товара для указания количества:' . PHP_EOL . '> ';
    $itemName = trim(fgets(STDIN));

    $key = array_search($itemName, $items, true);
    if ($key === false) {
        echo "Товара с таким наименованием нет в списке.\n";
        enterToContinue();
    } else {
        echo "Введите количество товара (натуральное число):\n> ";
        $quantity = trim(fgets(STDIN));
        if ((int) $quantity == $quantity && $quantity > 0) {
            $quantities[$itemName] = $quantity;
        } else {
            echo "Можно ввести только натуральное число товара в штуках.\n";
            enterToContinue();
        }
    }
}

function printBasket(array $items, bool $showCount = false) {
    global $quantities;
    echo "Ваш список покупок: " . PHP_EOL;
    foreach ($items as $item) {
        echo $item . (isset($quantities[$item]) ? " ($quantities[$item] шт.)" : "") . "\n";
    }

    if ($showCount) {
        echo 'Всего ' . count($items) . ' позиций. '. PHP_EOL;
        enterToContinue();
    }
}

do {
    clearScreen();
    printBasket($items);
    if (!count($items)) {
       echo "Ваш список покупок пуст.\n";
    }

    echo "Выберите операцию для выполнения:\n";
    // Проверить, есть ли товары в списке? Если нет, отображать только пункты 0 и 1
    if (count($items)) {
        echo implode(PHP_EOL, $operations) . PHP_EOL . '> ';
    } else {
        echo implode(PHP_EOL, [$operations[0], $operations[1]]) . PHP_EOL . '> ';
    }
    $operationNumber = trim(fgets(STDIN));
    if (!count($items) && $operationNumber > 1) {
        $operationNumber = -1;
    }
    if (!isset($operations[$operationNumber])) {
        echo "!!! Неизвестный номер операции, повторите попытку.\n";
        enterToContinue();
        continue;
    }
    echo "Выбрана операция: $operations[$operationNumber]\n";

    switch ($operationNumber) {
        case OPERATION_ADD:
            addToBasket($items);
            break;

        case OPERATION_DELETE:
            deleteFromBasket($items);
            break;

        case OPERATION_PRINT:
            printBasket($items, true);
            break;

        case OPERATION_RENAME:
            renameItem($items);
            break;

        case OPERATION_SET_QUANTITY:
            setQuantityForItem($items);
            break;
    }

    echo "\n ----- \n";
} while ($operationNumber != 0);

echo "Программа завершена\n";
