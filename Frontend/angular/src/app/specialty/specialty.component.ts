import { Component } from '@angular/core';
import { Specialty } from '../models/specialty.model';
import { SpecialtyService } from '../specialty.service';

@Component({
  selector: 'app-specialty',
  imports: [],
  templateUrl: './specialty.component.html',
  styleUrl: './specialty.component.css'
})
export class SpecialtyComponent {
  spelcialty: Specialty[] = []; // Cambié el nombre de la variable a "specialty" para que sea más claro
  constructor(private specialtyService: SpecialtyService) { }

  ngOnInit(): void {
    this.specialtyService.getSpecialty().subscribe(specialty => {
      this.spelcialty = specialty;
    });

  }
}
