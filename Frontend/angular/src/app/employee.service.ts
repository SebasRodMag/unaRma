import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Employee } from './models/employee.model';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class EmployeeService {
  private apiUrl = 'http://localhost:8001/employees';

  constructor(private http: HttpClient) { }
  getEmployee(): Observable<Employee[]> {
    return this.http.get<Employee[]>(this.apiUrl);
  }

  getEmployeeByName(nombre: string): Observable<Employee[]> {
    return this.http.get<Employee[]>(`${this.apiUrl}?nombre=${nombre}`);
  }
  getEmployeeBySurname(apellido: string): Observable<Employee[]> {
    return this.http.get<Employee[]>(`${this.apiUrl}?apellido=${apellido}`);
  }
  getEmployeeByDNI(DNI: string): Observable<Employee[]> {
    return this.http.get<Employee[]>(`${this.apiUrl}?DNI=${DNI}`);
  }
  getEmployeeByPhoneNumber(tlf: string): Observable<Employee[]> {
    return this.http.get<Employee[]>(`${this.apiUrl}?telefono=${tlf}`);
  }

  getEmployeeById(id: number): Observable<Employee> {
    return this.http.get<Employee>(`${this.apiUrl}/${id}`);
  }
  createEmployee(empleado: Employee): Observable<Employee> {
    return this.http.post<Employee>(this.apiUrl, empleado);
  }
  deleteEmployee(id: number): Observable<void> {
    return this.http.delete<void>(`${this.apiUrl}/${id}`);
  }
  updateEmployee(id: number, empleado: Employee): Observable<Employee> {
    return this.http.put<Employee>(`${this.apiUrl}/${id}`, empleado);
  }
}
