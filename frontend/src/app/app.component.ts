import { Component, OnInit } from '@angular/core';
import {FormControl} from '@angular/forms';
import {Observable} from 'rxjs';
import {map, startWith} from 'rxjs/operators';
import { DatePipe } from '@angular/common';


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
  filteredFilms: Observable<string[]>;
  filteredCustomers: Observable<string[]>;
  myControlFilm = new FormControl();
  myControlCustomer = new FormControl();
  myDate = new Date();
  // constructor(private datePipe: DatePipe){
  //   myDate = this.datePipe.transform(this.myDate, 'yyyy-MM-dd');
  // }

  ngOnInit() {
    this.filteredFilms = this.myControlFilm.valueChanges.pipe(
      startWith(''),
      map(value => this._filter(value))
    );
    this.filteredCustomers = this.myControlCustomer.valueChanges.pipe(
      startWith(''),
      map(value => this._filter(value))
    );
  }

  private _filter(value: string): string[] {
    const filterValue = value.toLowerCase();
    return this.films.filter(option => option.toLowerCase().indexOf(filterValue) === 0);
  }
}
