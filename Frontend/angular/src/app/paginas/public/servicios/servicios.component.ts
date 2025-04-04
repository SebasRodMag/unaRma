import { Component } from '@angular/core';
import { HeaderComponent } from '../../../components/header/header.component';
import { FooterComponent } from '../../../components/footer/footer.component';
import { ParallaxComponent } from "../../../components/parallax/parallax.component";
import { ComentariosComponent } from '../../../components/comentarios/comentarios.component';
import { HeadComponent } from '../../../components/head/head.component';

@Component({
  selector: 'app-servicios',
  imports: [ParallaxComponent, HeaderComponent, FooterComponent, ComentariosComponent, HeadComponent],
  templateUrl: './servicios.component.html',
  styleUrl: './servicios.component.css'
})
export class ServiciosComponent {

}
