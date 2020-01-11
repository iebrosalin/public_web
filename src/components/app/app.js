import React, {Component} from 'react';

import AppHeader from '../app-header';
import SearchPanel from '../search-panel';
import TodoList from '../todo-list';
import ItemStatusFilter from '../item-status-filter';
import ItemAddForm from '../item-add-form';

import './app.css';
import './bootstrap.min.css';

export default class App extends Component{
  constructor(){
      super();
      this.deleteItem=(id)=>{
          this.setState(({todoData})=>{
              const idx= todoData.findIndex((el)=>el.id===id);
              const newArray=[...todoData.slice(0,idx), ...todoData.slice (idx+1)];
              return {todoData:newArray};
          });
      };

      this.addItem=(text)=>{
          this.setState(({todoData})=>{
              const newArray=[...todoData, this.createTodoItem(text)];
              return {todoData:newArray};
          });
      }

      this.onToggleDone= (id)=>{
          this.setState(({todoData})=>{
              return {todoData:this.toggleProperty(todoData,id,'done')};
          });
      }

      this.onToggleImportant= (id)=>{
          this.setState(({todoData})=> {
              return {todoData:this.toggleProperty(todoData,id,'important')};
          });
      }

      this.onSearchChange=(term)=>{
          this.setState(({todoData})=> {
              return {term};
          });
      }
      this.onFilterChange=(filter)=>{
          this.setState(({todoData})=> {
              return {filter};
          });
      }
}

  state={
      todoData:[
          this.createTodoItem('Drink Coffee'),
          this.createTodoItem('Make Awesome App'),
          this.createTodoItem('Drink Coffee'),
      ],
      term:'',
      filter: 'active', //active, all done
  };
    toggleProperty(arr, id, propName){

        const idx= arr.findIndex((el)=>el.id===id);
        const oldItem=arr[idx];
        const newItem={...oldItem, [propName]: !oldItem[propName]};

        return [...arr.slice(0,idx),newItem ,...arr.slice (idx+1)];

    };
    createTodoItem(label){
        return {label:label, done: false, important:false, id: Math.round(Math.random()*10000)};
    }
    search(items, term){
        if(term==='') return items;
         return items.filter((item)=>{
            return item.label.toLowerCase().indexOf(term.toLowerCase())>-1;
        })
    }
    filter(items, filter){
        switch(filter){
            case 'all':
                return items;
            case 'active':
                return items.filter((item)=> !item.done);
            case 'done':
                return items.filter((item)=>item.done);
            default:
                return items;
        }
    }
  render(){
      const {todoData, term, filter}=this.state;
      const visibleItems = this.filter(this.search(todoData, term),filter);
      const doneCount=visibleItems.filter((el)=> el.done).length;
      const todoCount=visibleItems.length - doneCount;


      return (
          <div className="todo-app">
              <AppHeader toDo={todoCount} done={doneCount} />
              <div className="top-panel d-flex">
                  <SearchPanel
                  onSearchChange={this.onSearchChange}/>
                  <ItemStatusFilter
                      filter={filter}
                      onFilterChange={this.onFilterChange}/>
              </div>

              <TodoList
                  todos={visibleItems}
                  onDeleted={this.deleteItem}
                  onToggleImportant={this.onToggleImportant}
                  onToggleDone={this.onToggleDone}
              />
          <ItemAddForm
              onItemAdded={this.addItem}
          />
          </div>
      );
  }

};

