// src/modules/hotel/hotel.service.spec.ts
import { Test, TestingModule } from '@nestjs/testing';
import { HotelService } from './hotel.service';

describe('HotelService', () => {
  let service: HotelService;

  beforeEach(async () => {
    const module: TestingModule = await Test.createTestingModule({
      providers: [HotelService],
    }).compile();

    service = module.get<HotelService>(HotelService);
  });

  it('should be defined', () => {
    expect(service).toBeDefined();
  });

  it('should create a hotel', () => {
    const hotel = service.create('Grand Hotel', '123 Main St', '555-1234');
    expect(hotel).toEqual({
      id: 1,
      name: 'Grand Hotel',
      address: '123 Main St',
      phone: '555-1234',
    });
  });

  it('should find all hotels', () => {
    service.create('Grand Hotel', '123 Main St', '555-1234');
    const hotels = service.findAll();
    expect(hotels.length).toBe(1);
  });

  it('should find a hotel by id', () => {
    service.create('Grand Hotel', '123 Main St', '555-1234');
    const hotel = service.findOne(1);
    expect(hotel.id).toBe(1);
  });

  it('should update a hotel', () => {
    service.create('Grand Hotel', '123 Main St', '555-1234');
    const updated = service.update(1, 'Updated Hotel');
    expect(updated.name).toBe('Updated Hotel');
  });

  it('should delete a hotel', () => {
    service.create('Grand Hotel', '123 Main St', '555-1234');
    const deleted = service.remove(1);
    expect(deleted.id).toBe(1);
    expect(() => service.findOne(1)).toThrow('Hotel with ID 1 not found');
  });
});