import { Component, OnInit } from '@angular/core';
import {FormControl} from '@angular/forms';
import {Observable} from 'rxjs';
import {map, startWith} from 'rxjs/operators';
import { DatePipe } from '@angular/common';

import { ApiService } from './api.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
  providers: [DatePipe]
})
export class AppComponent implements OnInit {
  title = 'Order';
  films: string[] = ['Tarlin', 'Test', 'Hello'];
  customers: string[] = ['Dada', 'Asep', 'Aji'];
  buy: number;
  filteredFilms: Observable<string[]>;
  filteredCustomers: Observable<string[]>;
  myControlFilm = new FormControl();
  myControlCustomer = new FormControl();
  myDate = new Date();
  constructor(private apiService: ApiService){}


  ngOnInit() {
    this.apiService.getCustomers().subscribe((res)=>{
      console.log("res >>", res)
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
}