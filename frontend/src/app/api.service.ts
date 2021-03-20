import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import { Policy } from  './policy';
import { Observable, throwError } from  'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  PHP_API_SERVER = "http://127.0.0.1:8080";

  headers: HttpHeaders;

  constructor(private httpClient: HttpClient) {}

  readPolicies(): Observable<Policy[]>{
    return this.httpClient.get<Policy[]>(`${this.PHP_API_SERVER}/api/read.php`);
  }

  createPolicy(policy: Policy): Observable<Policy>{
    return this.httpClient.post<Policy>(`${this.PHP_API_SERVER}/api/create.php`, policy);
  }

  updatePolicy(policy: Policy){
    return this.httpClient.post<Policy>(`${this.PHP_API_SERVER}/api/update.php?id=${policy.id}`, policy);
  }

  deletePolicy(id: number){
    return this.httpClient.get<Policy>(`${this.PHP_API_SERVER}/api/delete.php/?id=${id}`);
  }
}
