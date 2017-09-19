<!DOCTYPE HTML> 
<html>
	<head>
		<title>VUE</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<style>
			.my-class-0{
				cursor:pointer;
			}
			.myclass-1{
				color:red;
			}
			.myclass-2{
				color:teal;
			}
			.cls-pusher{
				width:30px;
				height:30px;
				background-color:teal;
			}
			.router-link-active {
				color: red;
			}			
		</style>
		
		<script src="vue.js"></script>
		<script src="vue-router.js"></script>
	</head>
	
	<body>
		<div id="app">
			<hr>
			<router-link to="/foo">Go to Foo</router-link><br>
			<router-link to="/bar">Go to Bar</router-link><br>
			<router-link to="/user/123">Go to user:123</router-link><br>
			<router-link to="/abcd404page">Go to 404</router-link><br>
			<hr>
			<router-view>***</router-view>
			<hr>
			
			
			<p>{{ message }}</p>
			<p v-bind:title="mytitle">title</p>
			<p v-if="seen">Visible if var seen is true</p>
			<ol>
				<li v-for="itm in my_array">
				{{ itm.text }}
				</li>
			</ol>
			
			<p>{{ long_message }}</p>
			<button v-on:click="reverseMessage">reverse</button>			
			
			<p>{{ imp_message }}</p>
			<input v-model="imp_message">
			
			
			<ul>
				<todo-item 
					class='my-class-0'
					v-bind:class="{ 'myclass-2': isMyClass2, 'myclass-1': isMyClass1 }"
					
					v-for="item in component_items"
					v-bind:stuff="item"
					v-bind:key="item.id"
					>
				</todo-item>
			</ul>			
			
			<p class="my-class-0" v-on:click='switchClasses' v-bind:class="{ 'myclass-1': isMyClass1, 'myclass-2': isMyClass2 }">text with css classes</p>
			
			<div v-bind:class="classObject">text with css classes in class obejct</div>
			
			<div v-bind:class="[firstClass, secondClass]">class array</div>
			
			<div v-bind:style="{ color: activeColor, fontSize: fontSize + 'px' }">style binding</div>
			<div v-bind:style="styleObject">style binding in class object</div>
			
			<div v-bind:style="{ display: ['-webkit-box', '-ms-flexbox', 'flex'] }">style binding: display as array (-webkit-box, -ms-flexbox, flex) - will be used supported varian</div>
			
			<div v-if="type === 'A'">
			conditional render if--else-if--else: A: 
			<label>Имя пользователя</label>
			<input placeholder="Введите имя пользователя" key="username-input">			
			</div>
			<div v-else-if="type === 'B'">
			conditional render if--else-if--else: B: 
			<label>Email</label>
			<input placeholder="Введите адрес email" key="email-input">			
			</div>
			<div v-else-if="type === 'C'">
			conditional render if--else-if--else: C: 
			</div>
			<div v-else>
			conditional render if--else-if--else: NOT:(A/B/C)
			</div>			
			<?php /*			
			v-if производит “настоящий” условный рендеринг, удостоверяясь что подписчики событий и дочерние компоненты внутри блока должным образом уничтожаются и воссоздаются при изменении истинности управляющего условия.
			v-if также ленив: если условие ложно на момент первоначального рендеринга, он не произведёт никаких действий — условный блок не будет отображён, пока условие впервые не станет истинным.
			v-show, напротив, куда проще: элемент всегда присутствует в DOM, и только CSS-свойство переключается в зависимости от значения выражения.

			В целом у v-if выше стоимость переключения, а у v-show выше стоимость первичного рендеринга. Так что если вы предполагаете, что переключения будут частыми, используйте v-show, если же редкими или вовсе маловероятными — v-if.
			v-if вместе с v-for

			При совместном использовании v-if и v-for, v-for имеет более высокий приоритет.
			*/?>
			<ul>
				<template v-for="n in 4">
					<li>{{ n }}</li>
					<hr>
				</template>
			</ul>
			
			<li v-for="todox in todosx">
				<template v-if="!todox.isComplete">
					<span class='myclass-2'>
					{{ todox.text }}
					</span>
				</template>
				<template v-else>
					<span class='myclass-1'>
					{{ todox.text }}
					</span>
				</template>
				
			</li>
			
			<input
			  v-model="newTodoText"
			  v-on:keyup.enter="addNewTodo"
			  placeholder="Добавить todo"
			>
			<ul>
			  <li
			    is="todo-item-list"
			    v-for="(todo, index) in todos"
			    v-bind:key="todo.id"
			    v-bind:title="todo.title"
			    v-on:remove="todos.splice(index, 1)"
			  ></li>
			</ul>	
				
			<button v-on:click="say('my parameter', $event)">inline events with inline param</button>
			<?php/*			
			<!-- событие click не будет всплывать дальше -->
			<a v-on:click.stop="doThis"></a>
			<!-- событие submit больше не будет перезагружать страницу -->
			<form v-on:submit.prevent="onSubmit"></form>
			<!-- модификаторы можно объединять в цепочки -->
			<a v-on:click.stop.prevent="doThat"></a>
			<!-- и использовать без указания пользовательского обработчика -->
			<form v-on:submit.prevent></form>
			<!-- при добавлении слушателя события можно использовать capture mode -->
			<!-- т.е. событие направленное на внутренний элемент сначала обрабатывается здесь перед тем, как обрабатываться этим элементом -->
			<div v-on:click.capture="doThis">...</div>
			<!-- вызывать обработчик только в случае наступления события непосредственно -->
			<!-- на данном элементе (то есть не на дочернем компоненте) -->
			<div v-on:click.self="doThat">...</div>
			<!-- Событие click сработает только 1 раз -->
			<a v-on:click.once="doThis"></a>
			<!-- аналогично примеру выше -->
			<input v-on:keyup.13="submit">
			<input v-on:keyup.enter="submit">
			<!-- работает также и в сокращённой записи -->
			<input @keyup.enter="submit">
			
			Вот полный список поддерживаемых псевдонимов:
			.enter
			.tab
			.delete (ловит как “Delete”, так и “Backspace”)
			.esc
			.space
			.up
			.down
			.left
			.right

			// включит v-on:keyup.f1
			Vue.config.keyCodes.f1 = 112
			
			
			.ctrl
			.alt
			.shift
			.meta
			<!-- Alt + C -->
			<input @keyup.alt.67="clear">
			
			// MOUSE
			.left
			.right
			.middle
			*/?>
			
			<hr>
			<span>textarea text:</span>
			<p style="white-space: pre-line;">{{ message }}</p>
			<br>
			<textarea v-model="message" placeholder="введите несколько строчек"></textarea>			
			<br>
			<input type="checkbox" id="checkbox" v-model="checked">
			<label for="checkbox">{{ checked }}</label>	
			<hr>
			<div id="example-3" class="demo">
			  <input type="checkbox" id="jack" value="Jack" v-model="checkedNames">
			  <label for="jack">Jack</label>
			  <input type="checkbox" id="john" value="John" v-model="checkedNames">
			  <label for="john">John</label>
			  <input type="checkbox" id="mike" value="Mike" v-model="checkedNames">
			  <label for="mike">Mike</label>
			  <br>
			  <span>Selected Names: {{ checkedNames }}</span>
			</div>	
			<hr>
			<input type="radio" id="one" value="One" v-model="picked">
			<label for="one">One</label>
			<br>
			<input type="radio" id="two" value="Two" v-model="picked">
			<label for="two">Two</label>
			<br>
			<span>Picked value: {{ picked }}</span>		
			<hr>
			<select v-model="dbox_selected">
			  <option disabled value="">Select one</option>
			  <option>A</option>
			  <option>B</option>
			  <option>C</option>
			</select>
			<span>Selected: {{ dbox_selected }}</span>
			<hr>
			<div id="counter-event-example">
			  <p>{{ pusher_global_increment }}</p>
			  <pusher v-on:increment="pusherGlobalIncrement"></pusher>
			  <pusher v-on:increment="pusherGlobalIncrement"></pusher>
			</div>			
			
			<hr>
		</div>	
		
		<script>
			var NotFound = { template: '<p>404</p>' }
			var Foo	 = { template: '<div>foo</div>' };
			var Bar	 = { template: '<div>bar</div>' };
			var User = { 
				template: '<div>User {{ $route.params.id }}</div>',
				beforeRouteUpdate (to, from, next) {
					// обработка изменений параметров пути...
					// не забудьте вызывать next()
					next();
				}
			};
			var routes = [
				{ path: '/foo',		component: Foo },
				{ path: '/bar',		component: Bar },
				{ path: '/user/:id',	component: User }
			];
			var router = new VueRouter({
				routes
			})			
		
		
			Vue.component('todo-item', {
				props: ['stuff'],
				template: '<li class="{myclass-0}">{{ stuff.text }}</li>'
			});			
			
			Vue.component('todo-item-list', {
				props: ['title'],
				template: 
				'<li>' +
					'{{ title }}' +
					'<button v-on:click="$emit(\'remove\')">X</button>' +
				'</li>'
			})			
			
			Vue.component('pusher', {
				props:	  ['pusher_counter'],
				template: '<div class="cls-pusher" v-on:click="pusherIncrement">{{counter}}</div>',
				data: function () {
					return {
						counter: 0
					}
				},
				methods: {
					pusherIncrement: function () {
						this.counter += 1;
						this.$emit('increment');
					}
				}
			});
			
			/*/
			// Наш объект data
			var data = { a: 1 }
			// Объект добавляется в экземпляр Vue
			var vm = new Vue({
			  data: data (or data:[] if nothing @ init but will be created later)
			})
			// Ссылки указывают на один и тот же объект!
			vm.a === data.a // => true
			// Изменение свойства экземпляра
			// будет влиять на оригинальные данные
			vm.a = 2
			data.a // => 2
			// ... и наоборот
			data.a = 3
			vm.a // => 3
			/**/
			
			var app = new Vue({
				el: '#app',
				router: router,
				data: {
					currentRoute: window.location.pathname,
					
					message: 'Test: ' + new Date().toLocaleString(),
					mytitle: 'My New Title',
					seen: true,
					
					my_array: [
						{ text: 'array value 0' },
						{ text: 'array value 1' },
						{ text: 'array value 2' }					
					],
					
					long_message: '0123456789',
					
					imp_message: 'input message',
					
					component_items: [
						{ id: 0, text: 'stuff 0' },
						{ id: 1, text: 'stuff 1' },
						{ id: 2, text: 'stuff 2' }
					],
					
					isMyClass1 : false,
					isMyClass2 : true,
					
					classObject:{
						'myclass-1': true,
						'myclass-2': false
					},
					
					firstClass: 'myclass-1',
					secondClass: 'myclass-2',
					
					
					activeColor: 'olive',
					fontSize: 30,
					styleObject: {
						color: 'navy',
						fontSize: '22px'
					},
					
					type: 'B',
					
					todosx: [
						{isComplete: false, text:'todox text 0'},
						{isComplete: true, text:'todox text 1'},
						{isComplete: false, text:'todox text 2'},
					],
					
					newTodoText: '',
					todos: [
						{id: 0, isComplete: false, title:'todo title 0'},
						{id: 1, isComplete: true, title:'todo title 1'},
						{id: 2, isComplete: false, title:'todo title 2'},
					],
					nextTodoId: 4,
					
					checked: true,
					
					checkedNames: [],
					
					picked: 'One',
					
					dbox_selected: '',
					
					pusher_global_increment: 0
				},
				watch: {
					imp_message: function(param){
						console.log(param);
					}
				},
				methods: {
					reverseMessage: function () {
						this.long_message = this.long_message.split('').reverse().join('')
					},
					
					switchClasses: function(){
						this.isMyClass1 = !this.isMyClass1;
						this.isMyClass2 = !this.isMyClass1;
					},
					
					addNewTodo: function () {
						this.todos.push({
							id: this.nextTodoId++,
							title: this.newTodoText
						})
						this.newTodoText = ''
					},
					
					say: function (message, event) {
						if (event) event.preventDefault(); // orifinal event
						alert(message);
					},
					
					pusherGlobalIncrement: function () {
					  this.pusher_global_increment += 1
					}					
				},
				
				created: function () {
					console.log('instance of vue: ' + this);
				},
				
				/*/
				computed: {
					ViewComponent () {
						return routes[this.currentRoute] || NotFound
					}
				},
				render (h) { 
					return h(this.ViewComponent) 
				}
				/**/
		
				//mounted
				//	this.$nextTick(function () { 
				//		Код, который будет запущен только после 
				//		отображения всех представлений
				//	})
				//updated [try to avoid this func]
				//	  this.$nextTick(function () {
				//		Код, который будет запущен только после
				//		обновления всех представлений
				//	})
				//destroyed
			});
		</script>
				
	</body>
</html>