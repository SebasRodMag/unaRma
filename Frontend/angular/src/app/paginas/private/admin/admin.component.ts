import { Component, inject } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { HeadComponent } from '../../../components/head/head.component';
import { FooterComponent } from '../../../components/footer/footer.component';
import { HeaderComponent } from '../../../components/header/header.component';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { AuthService } from '../../../services/authService/auth.service';
import { CustomerListComponentComponent } from '../../../components/cruds-admin/customer-list-component/customer-list-component.component';
import { catchError, mergeMap, throwError } from 'rxjs';

@Component({
  selector: 'app-admin',
  imports: [RouterOutlet, HeadComponent, FooterComponent, HeaderComponent, CustomerListComponentComponent],
  templateUrl: './admin.component.html',
  styleUrl: './admin.component.css'
})
export class AdminComponent {

}
