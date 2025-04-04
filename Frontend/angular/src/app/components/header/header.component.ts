import { Component, inject } from '@angular/core';
import { RouterModule } from '@angular/router';
import { AuthService } from '../../services/authService/auth.service';
import { Route } from '@angular/router';
import { Router } from '@angular/router';
@Component({
  selector: 'app-header',
  imports: [RouterModule],
  templateUrl: './header.component.html',
  styleUrl: './header.component.css',
})
export class HeaderComponent {
  authservice = inject(AuthService);
  router = inject(Router)
  isLoggedIn : boolean = false

  constructor(){
    if (localStorage.getItem('authToken')) {
      this.isLoggedIn = true
    }
  }

  logout() {
    this.authservice
      .logout(localStorage.getItem('authToken') || '')
      .subscribe((res: any) => {
        localStorage.removeItem('authToken')
        this.router.navigateByUrl('/login')
      });
  }
}
