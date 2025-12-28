<script setup lang="ts">
interface Pizza {
    id: number;
    name: string;
    price: number;
}

interface Order {
    id: number;
    pizza: Pizza;
    status: 'ordered' | 'completed';
}

let nextMenuId: number = 1;
let nextOrderId: number = 1;
let cashRegister: number = 100;

const menu: Pizza[] = [
    { id: nextMenuId++, name: 'Margherita', price: 10.99 },
    { id: nextMenuId++, name: 'Peperoni', price: 12.99 },
    { id: nextMenuId++, name: 'Hawaiian', price: 13.99 },
    { id: nextMenuId++, name: 'Meat Lovers', price: 14.99 },
    { id: nextMenuId++, name: 'Vegetarian', price: 15.99 },
];

const orderQueue: Order[] = [];

function addNewPizza(pizzaObj: Omit<Pizza, 'id'>): void {
    menu.push({
        id: nextMenuId++,
        ...pizzaObj
    });
}

function placeOrder(pizzaName: string): Order {
    const selectedPizza: Pizza | undefined = menu.find((pizza) => pizza.name === pizzaName);

    if (!selectedPizza) {
        throw new Error('Pizza not found');
    }

    cashRegister += selectedPizza.price;
    const newOrder: Order = { id: nextOrderId++, pizza: selectedPizza, status: 'ordered' };
    orderQueue.push(newOrder);
    return newOrder;
}

function completeOrder(orderId: number): Order {
    const order: Order | undefined = orderQueue.find((order) => order.id === orderId);

    if (!order) {
        throw new Error('Order not found');
    }

    order.status = 'completed';
    return order;
}

function getPizzaDetail(identifier: number | string): Pizza {
    if (typeof identifier === 'number') {
        const pizza: Pizza | undefined = menu.find((pizza) => {
            return pizza.id === identifier
        });
        if (!pizza) {
            throw new Error('Pizza not on menu');
        }
        return pizza;
    } else if (typeof identifier === 'string') {
        const pizza: Pizza | undefined = menu.find((pizza) => {
            return pizza.name.toLowerCase() === identifier.toLowerCase()
        });
        if (!pizza) {
            throw new Error('Pizza not on menu');
        }
        return pizza;
    } else {
        throw new Error('Invalid identifier');
    }
}

addNewPizza({ name: 'Sausage', price: 16.99 });
addNewPizza({ name: 'Salami', price: 17.99 });
addNewPizza({ name: 'Supreme', price: 29.99 });

placeOrder('Meat Lovers');
completeOrder(1);
getPizzaDetail(1);

console.log('Menu:', menu);
console.log('Cash Register:', cashRegister);
console.log('Order Queue:', orderQueue);
</script>

<template>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg">
                <!-- Header -->
                <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Pizzas</h1>
                        <p class="mt-1 text-sm text-gray-500">Manage the pizza menu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
