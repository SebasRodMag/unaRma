import { HttpClient } from '@angular/common/http';
import { Component, inject } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from '../../../services/authService/auth.service';

@Component({
  selector: 'app-login',
  imports: [FormsModule],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css',
})
export class LoginComponent {
  loginObj: any = {
    email: '',
    contrasena: '',
  };

  router = inject(Router);
  http = inject(HttpClient);
  authService = inject(AuthService);

  onLogin() {
    this.authService.login(this.loginObj).subscribe(
      (response) => {
        localStorage.setItem('authToken', response.token);
        console.log('Login exitoso:', response);
        this.router.navigateByUrl('/')
      },
      (error) => {
        console.error('Error en el login:', error);
      }
    );
  }
}
