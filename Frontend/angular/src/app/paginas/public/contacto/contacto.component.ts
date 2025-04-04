import { Component } from '@angular/core';
import { HeaderComponent } from '../../../components/header/header.component';
import { FooterComponent } from '../../../components/footer/footer.component';
import { ParallaxComponent } from "../../../components/parallax/parallax.component";
import { HeadComponent } from '../../../components/head/head.component';

@Component({
  selector: 'app-contacto',
  imports: [HeaderComponent, FooterComponent, ParallaxComponent, HeadComponent],
  templateUrl: './contacto.component.html',
  styleUrl: './contacto.component.css'
})
export class ContactoComponent {

}
