import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Order } from './order';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  apiURL: string = 'http://localhost:8000/api/v1';
  constructor(private httpClient: HttpClient) {}

  public getCustomers(){
   return this.httpClient.get(`${this.apiURL}/orders/customers`);
  }

  public createOrder(order: Order){
    return this.httpClient.post(`${this.apiURL}/orders/create`, order);
  }

  public getCustomerByCode(code: string){
    return this.httpClient.get(`${this.apiURL}/orders/customers/${code}`);
  }
}
