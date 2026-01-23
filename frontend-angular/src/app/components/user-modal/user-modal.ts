import { Component, EventEmitter, Output } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { UserService, User } from '../../services/user.service';

@Component({
  selector: 'app-user-modal',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './user-modal.html',
  styleUrls: ['./user-modal.scss']
})
export class UserModalComponent {

  @Output() userAdded = new EventEmitter<User>();

  newUser: Partial<User> = {
    nom: '',
    prenom: '',
    email: '',
    adresse: '',
    tel: '',
    birthDate: ''
  };

  constructor(private userService: UserService) {}

  @Output() closed = new EventEmitter<void>();

  close(): void {
    this.closed.emit();
    this.resetForm();
  }

  resetForm(): void {
    this.newUser = {
      nom: '',
      prenom: '',
      email: '',
      adresse: '',
      tel: '',
      birthDate: ''
    };
  }

  submit(): void {
    const userToAdd: User = {
      id: 0,
      nom: this.newUser.nom!,
      prenom: this.newUser.prenom!,
      email: this.newUser.email!,
      adresse: this.newUser.adresse!,
      tel: this.newUser.tel!,
      birthDate: this.newUser.birthDate!,
      age: 0
    };

    this.userService.addUser(userToAdd).subscribe({
      next: (user) => {
        this.userAdded.emit(user);
        this.close();
      },
      error: (err) => console.error('Erreur création utilisateur', err)
    });
  }
}
