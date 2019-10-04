import { Component, OnInit } from '@angular/core';
import {FormControl} from '@angular/forms';
import {Observable} from 'rxjs';
import {map, startWith} from 'rxjs/operators';
import { DatePipe } from '@angular/common';

import { ApiService } from './api.service';
import { ValueConverter } from '@angular/compiler/src/render3/view/template';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
  providers: [DatePipe]
})
export class AppComponent implements OnInit {
  title = 'Order';
  films: string[] = [];
  customers: string[] = [];
  filteredFilms: Observable<string[]>;
  filteredCustomers: Observable<string[]>;
  myControlFilm = new FormControl();
  myControlCustomer = new FormControl();
  myDate = new Date();
  name: string
  phone: string
  email: string
  film_name: string
  time: string
  buy: number
  
  constructor(private apiService: ApiService){}


  ngOnInit() {
    this.apiService.getCustomers().subscribe((res)=>{
      // res.bodyresults.data.map(value => this._filter(value)){
      //   return value.code
      // }
    });
    this.filteredFilms = this.myControlFilm.valueChanges.pipe(
      startWith(''),
      map(value => this._filter(value))
    );
    this.filteredCustomers = this.myControlCustomer.valueChanges.pipe(
      startWith(''),
      map(value => this._filter(value))
    );
  }

  canceled(){
    this.films = []
    this.buy = 0
  }

  private _filter(value: string): string[] {
    const filterValue = value.toLowerCase();
    return this.films.filter(option => option.toLowerCase().indexOf(filterValue) === 0);
  }

  onSelectionChange(event) {
    this.apiService.getCustomerByCode(event.option.value).subscribe((res)=>{
      console.log(" >> ", res)
      // try {
      //   let row = res.body.results
      //   this.name = row.name
      //   this.phone = row.phone
      //   this.email = row.email
      // } catch (e) {
      //   console.log("errro >", e)
      // }
    })
  }

  createOrder(){
    // this.apiService.createOrder({
    //   code: '',
    //   ticket_code: '',
    //   customer_code: '',
    // }).subscribe((res)=>{
    //       console.log("Created a customer");
    // });
  }
}