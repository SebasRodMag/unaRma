import { Component } from '@angular/core';
import { HeaderComponent } from '../../../components/header/header.component';
import { FooterComponent } from '../../../components/footer/footer.component';
import { HeadComponent } from '../../../components/head/head.component';

@Component({
  selector: 'app-acerca-de',
  imports: [HeaderComponent, FooterComponent, HeadComponent],
  templateUrl: './acerca-de.component.html',
  styleUrl: './acerca-de.component.css'
})
export class AcercaDeComponent {

}
