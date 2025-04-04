import { Component } from '@angular/core';
import { HeaderComponent } from '../../../components/header/header.component';
import { FooterComponent } from '../../../components/footer/footer.component';
import { ParallaxComponent } from "../../../components/parallax/parallax.component";
import { HeadComponent } from '../../../components/head/head.component';

@Component({
  selector: 'app-equipo',
  imports: [HeaderComponent, FooterComponent, ParallaxComponent, HeadComponent],
  templateUrl: './equipo.component.html',
  styleUrl: './equipo.component.css'
})
export class EquipoComponent {

}
