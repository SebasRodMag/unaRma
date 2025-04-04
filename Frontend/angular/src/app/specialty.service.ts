import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Employee } from './models/employee.model';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class SpecialtyService {

  constructor(private http: HttpClient) { }
  private apiUrl = 'http://localhost:8001/especialidades';
  getSpecialty(): Observable<Employee[]> {
    return this.http.get<Employee[]>(this.apiUrl);
  }
  getSpecialtyByName(nombre: string): Observable<Employee[]> {
    return this.http.get<Employee[]>(`${this.apiUrl}?nombre=${nombre}`);
  }
}
