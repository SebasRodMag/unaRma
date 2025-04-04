import { Routes } from '@angular/router';
import { IndexComponent } from './paginas/public/index/index.component';
import { ContactoComponent } from './paginas/public/contacto/contacto.component';
import { EquipoComponent } from './paginas/public/equipo/equipo.component';
import { ServiciosComponent } from './paginas/public/servicios/servicios.component';
import { AcercaDeComponent } from './paginas/public/acerca-de/acerca-de.component';
import { LoginComponent } from './paginas/public/login/login.component';
import { LayoutComponent } from './paginas/public/layout/layout.component';
import { AdminComponent } from './paginas/private/admin/admin.component';
import { RegisterComponent } from './paginas/public/register/register.component';
//import { authGuard } from './components/paginas/private/auth.guard';

export const routes: Routes = [
  { path: '', redirectTo: 'inicio', pathMatch: 'full' }, //Ruta por defecto
  { path: 'login', component: LoginComponent },
  {
    path: '',
    component: LayoutComponent,
    children: [
      //Aquí van las páginas que se podrán ver al estar loggeado.
      { path: 'admin', component: AdminComponent },
      { path: 'inicio', component: IndexComponent },
      { path: 'equipo', component: EquipoComponent },
      { path: 'servicios', component: ServiciosComponent },
      { path: 'contacto', component: ContactoComponent },
      { path: 'acercaDe', component: AcercaDeComponent },
      { path: 'register', component: RegisterComponent },
    ],
  },
  //rutas mientras el login se esta trabajando, borrar despues
  { path: 'inicio', component: IndexComponent },
  { path: 'equipo', component: EquipoComponent },
  { path: 'servicios', component: ServiciosComponent },
  { path: 'contacto', component: ContactoComponent },
  { path: 'acercaDe', component: AcercaDeComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'admin', component: AdminComponent },
];
